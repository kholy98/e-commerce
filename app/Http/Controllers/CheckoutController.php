<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shipment;
use App\Services\SessionCartService;
use App\Services\OrderService;
use App\Services\BostaApiService;
use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected SessionCartService $cartService;
    protected OrderService $orderService;
    protected BostaApiService $bostaService;
    protected PaymentGatewayInterface $paymentGateway;

    public function __construct(
        SessionCartService $cartService,
        OrderService $orderService,
        BostaApiService $bostaService,
        PaymentGatewayInterface $paymentGateway
    ) {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->bostaService = $bostaService;
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * Initiate checkout process - create shipment and payment
     */
    public function initiate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'shipping_address' => 'required|array',
            'shipping_address.street' => 'required|string',
            'shipping_address.city' => 'required|string',
            'shipping_address.zip_code' => 'required|string',
            'shipping_address.country' => 'required|string',
            'shipping_address.building_number' => 'required|string',
            'shipping_address.floor' => 'nullable|string',
            'shipping_address.apartment' => 'nullable|string',
            'shipping_address.zone' => 'required|string',
            'billing_address' => 'required|array',
            'billing_address.first_name' => 'required|string',
            'billing_address.last_name' => 'required|string',
            'billing_address.email' => 'required|email',
            'billing_address.phone' => 'required|string',
            'billing_address.street' => 'required|string',
            'billing_address.city' => 'required|string',
            'billing_address.zip_code' => 'required|string',
            'billing_address.country' => 'required|string',
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id', // For guest checkout with user creation
        ]);

        try {
            $cartItems = $this->cartService->getCartItems();

            if (empty($cartItems)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty',
                ], 422);
            }

            // Calculate totals
            $summary = $this->cartService->getSummary();
            
            // Create temporary order data (not saved to database yet)
            $orderData = [
                'user_id' => Auth::check() ? Auth::id() : ($validated['user_id'] ?? null),
                'items' => $cartItems,
                'total_amount' => $summary['total'],
                'subtotal' => $summary['subtotal'],
                'tax' => $summary['tax'],
                'shipping_cost' => $summary['shipping'],
                'shipping_address' => $validated['shipping_address'],
                'billing_address' => $validated['billing_address'],
                'notes' => $validated['notes'] ?? null,
            ];

            // Store order data in session for payment completion
            session(['pending_order_data' => $orderData]);

            // Step 1: Create shipment with Bosta
            $shipmentPayload = [
                'type' => 10, // Required field for Bosta API - 10 = standard delivery
                'receiver_first_name' => $validated['billing_address']['first_name'],
                'receiver_last_name' => $validated['billing_address']['last_name'],
                'receiver_phone' => $validated['billing_address']['phone'],
                'receiver_email' => $validated['billing_address']['email'],
                'building_number' => $validated['shipping_address']['building_number'],
                'floor' => $validated['shipping_address']['floor'] ?? null,
                'apartment' => $validated['shipping_address']['apartment'] ?? null,
                'first_line' => $validated['shipping_address']['street'],
                'city' => $validated['shipping_address']['city'],
                'zone' => $validated['shipping_address']['zone'],
                'notes' => $validated['notes'] ?? '',
                'cod' => 0, // We're using online payment, no COD
            ];

            $shipmentResponse = $this->bostaService->createDelivery($shipmentPayload);

            if (!$shipmentResponse['success']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create shipment',
                    'error' => $shipmentResponse['error'] ?? 'Unknown error',
                ], 422);
            }

            // Store shipment data in session
            session(['pending_shipment_data' => [
                'tracking_number' => $shipmentResponse['data']['trackingNumber'],
                'status' => $shipmentResponse['data']['state']['value'],
            ]]);

            // Step 2: Initiate payment with Paymob
            $paymentData = [
                'amount_cents' => intval($summary['total'] * 100), // Convert to cents
                'currency' => 'EGP',
                'order_id' => 'TEMP-' . time(), // Temporary order ID
                'billing_data' => [
                    'first_name' => $validated['billing_address']['first_name'],
                    'last_name' => $validated['billing_address']['last_name'],
                    'email' => $validated['billing_address']['email'],
                    'phone' => $validated['billing_address']['phone'],
                    'street' => $validated['billing_address']['street'],
                    'city' => $validated['billing_address']['city'],
                    'country' => $validated['billing_address']['country'],
                    'postal_code' => $validated['billing_address']['zip_code'],
                ],
            ];

            $paymentResponse = $this->paymentGateway->sendPayment(new Request($paymentData));

            if (!$paymentResponse['success']) {
                // If payment fails, we should cancel the shipment
                return response()->json([
                    'success' => false,
                    'message' => 'Payment initiation failed',
                    'error' => $paymentResponse['message'] ?? 'Payment error',
                ], 422);
            }

            return response()->json([
                'success' => true,
                'message' => 'Checkout initiated successfully',
                'data' => [
                    'payment_key' => $paymentResponse['payment_key'],
                    'iframe_url' => $paymentResponse['iframe_url'],
                    'temp_order_id' => $paymentResponse['order_id'],
                    'tracking_number' => $shipmentResponse['data']['trackingNumber'],
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Checkout failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Complete checkout after successful payment
     * This is called by the payment webhook or callback
     */
    public function complete(Request $request): JsonResponse
    {
        try {
            $pendingOrderData = session('pending_order_data');
            $pendingShipmentData = session('pending_shipment_data');

            if (!$pendingOrderData || !$pendingShipmentData) {
                return response()->json([
                    'success' => false,
                    'message' => 'No pending checkout found',
                ], 404);
            }

            // Validate payment success from the request
            $paymentSuccess = $request->input('success', false);
            $paymentId = $request->input('payment_id');

            if (!$paymentSuccess) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment was not successful',
                ], 422);
            }

            // Now create the actual order
            $order = $this->orderService->createOrderAfterPayment(
                $pendingOrderData,
                $pendingShipmentData,
                $paymentId
            );

            // Clear cart and session data
            $this->cartService->clearCart();
            session()->forget(['pending_order_data', 'pending_shipment_data']);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order->load('items.product'),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order creation failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle checkout failure (payment or shipment failure)
     */
    public function fail(Request $request): JsonResponse
    {
        // Clear session data
        session()->forget(['pending_order_data', 'pending_shipment_data']);

        return response()->json([
            'success' => false,
            'message' => 'Checkout failed',
            'error' => $request->input('error', 'Unknown error'),
        ]);
    }

    /**
     * Get checkout status
     */
    public function status(Request $request): JsonResponse
    {
        $pendingOrderData = session('pending_order_data');
        $pendingShipmentData = session('pending_shipment_data');

        return response()->json([
            'success' => true,
            'data' => [
                'has_pending_checkout' => !empty($pendingOrderData),
                'cart_summary' => $this->cartService->getSummary(),
                'cart_items_count' => $this->cartService->getItemCount(),
            ],
        ]);
    }
}