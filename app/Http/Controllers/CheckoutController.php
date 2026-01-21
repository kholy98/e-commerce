<?php

namespace App\Http\Controllers;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Cart;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\PendingCheckout;
use App\Models\Shipment;
use App\Services\BostaApiService;
use App\Services\OrderService;
use App\Services\SessionCartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group Checkout
 *
 * APIs for the checkout process.
 *
 * The checkout flow consists of:
 * 1. Initiate checkout - validates cart, creates pending checkout, and returns payment URL
 * 2. Payment processing - handled by payment gateway (Paymob)
 * 3. Complete/Fail callbacks - finalize or cancel the order based on payment result
 *
 * Supports both guest checkout and authenticated user checkout.
 */
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
     * Initiate checkout
     *
     * Start the checkout process by validating the cart, creating a pending checkout,
     * and returning a payment URL. Supports both guest and authenticated users.
     *
     * @unauthenticated
     *
     * @bodyParam shipping_address object required The shipping address details.
     * @bodyParam shipping_address.street string required The street address. Example: 123 Main St
     * @bodyParam shipping_address.city string required The city name. Example: Cairo
     * @bodyParam shipping_address.zip_code string required The postal/zip code. Example: 12345
     * @bodyParam shipping_address.country string required The country name. Example: Egypt
     * @bodyParam shipping_address.building_number string required The building number. Example: 15
     * @bodyParam shipping_address.floor string The floor number. Example: 3
     * @bodyParam shipping_address.apartment string The apartment number. Example: 5A
     * @bodyParam shipping_address.zone string required The zone/district. Example: Maadi
     * @bodyParam billing_address object required The billing address and contact details.
     * @bodyParam billing_address.first_name string required Customer's first name. Example: John
     * @bodyParam billing_address.last_name string required Customer's last name. Example: Doe
     * @bodyParam billing_address.email string required Customer's email address. Example: john@example.com
     * @bodyParam billing_address.phone string required Customer's phone number. Example: +201234567890
     * @bodyParam billing_address.street string required The billing street address. Example: 123 Main St
     * @bodyParam billing_address.city string required The billing city. Example: Cairo
     * @bodyParam billing_address.zip_code string required The billing postal/zip code. Example: 12345
     * @bodyParam billing_address.country string required The billing country. Example: Egypt
     * @bodyParam billing_address.floor string The floor number. Example: 3
     * @bodyParam billing_address.apartment string The apartment number. Example: 5A
     * @bodyParam notes string Optional order notes. Example: Please deliver in the morning
     * @bodyParam user_id string Optional user ID for guest checkout with user creation.
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Checkout initiated successfully",
     *   "data": {
     *     "checkout_id": "chk_abc123",
     *     "payment_url": "https://accept.paymob.com/api/acceptance/iframes/12345?payment_token=xyz",
     *     "order_summary": {
     *       "subtotal": 100.00,
     *       "shipping": 50.00,
     *       "tax": 14.00,
     *       "total": 164.00,
     *       "item_count": 3
     *     },
     *     "expires_at": "2024-01-15T11:00:00.000000Z"
     *   }
     * }
     * @response 422 scenario="Empty Cart" {
     *   "success": false,
     *   "message": "Cart is empty"
     * }
     * @response 422 scenario="Validation Error" {
     *   "message": "The shipping address.street field is required.",
     *   "errors": {
     *     "shipping_address.street": ["The shipping address.street field is required."]
     *   }
     * }
     */
    public function initiate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'shipping_address_id' => 'nullable|exists:customer_addresses,id',
            'billing_address_id' => 'nullable|exists:customer_addresses,id',
            'shipping_address' => 'required_without:shipping_address_id|array',
            'shipping_address.street' => 'required_with:shipping_address|string',
            'shipping_address.city' => 'required_with:shipping_address|string',
            'shipping_address.zip_code' => 'required_with:shipping_address|string',
            'shipping_address.country' => 'required_with:shipping_address|string',
            'shipping_address.building_number' => 'required_with:shipping_address|string',
            'shipping_address.floor' => 'nullable|string',
            'shipping_address.apartment' => 'nullable|string',
            'shipping_address.zone' => 'required_with:shipping_address|string',
            'billing_address' => 'required_without:billing_address_id|array',
            'billing_address.first_name' => 'required_with:billing_address|string',
            'billing_address.last_name' => 'required_with:billing_address|string',
            'billing_address.email' => 'required_with:billing_address|email',
            'billing_address.phone' => 'required_with:billing_address|string',
            'billing_address.street' => 'required_with:billing_address|string',
            'billing_address.city' => 'required_with:billing_address|string',
            'billing_address.zip_code' => 'required_with:billing_address|string',
            'billing_address.country' => 'required_with:billing_address|string',
            'billing_address.floor' => 'nullable|string',
            'billing_address.apartment' => 'nullable|string',
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id', // For guest checkout with user creation
        ]);

        // Load stored addresses if IDs are provided
        $shippingAddress = null;
        $billingAddress = null;

        if (isset($validated['shipping_address_id'])) {
            $shippingAddress = CustomerAddress::where('id', $validated['shipping_address_id'])
                ->where('user_id', Auth::id())
                ->first();

            if (!$shippingAddress) {
                return response()->json([
                    'success' => false,
                    'message' => 'Shipping address not found',
                ], 404);
            }
        }

        if (isset($validated['billing_address_id'])) {
            $billingAddress = CustomerAddress::where('id', $validated['billing_address_id'])
                ->where('user_id', Auth::id())
                ->first();

            if (!$billingAddress) {
                return response()->json([
                    'success' => false,
                    'message' => 'Billing address not found',
                ], 404);
            }
        }

        try {
            $cartItems = $this->cartService->getCartItems();

            if (empty($cartItems)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart is empty',
                ], 422);
            }

            // Calculate totals with Bosta shipping pricing
            $summary = $this->cartService->getSummary($validated['shipping_address']['city']);

            // Create temporary order data (not saved to database yet)
            $orderData = [
                'user_id' => Auth::check() ? Auth::id() : ($validated['user_id'] ?? null),
                'status' => \App\Models\Order::STATUS_PENDING,
                'items' => $cartItems,
                'total_amount' => $summary['total'],
                'subtotal' => $summary['subtotal'],
                'tax' => $summary['tax'],
                'shipping_cost' => $summary['shipping'],
                'shipping_address' => $shippingAddress ? $shippingAddress->toArray() : $validated['shipping_address'],
                'billing_address' => $billingAddress ? $billingAddress->toArray() : $validated['billing_address'],
                'shipping_address_id' => $shippingAddress?->id,
                'billing_address_id' => $billingAddress?->id,
                'notes' => $validated['notes'] ?? null,
            ];

            // Step 1: Create shipment with Bosta
            if ($billingAddress) {
                $billingData = $billingAddress->toPaymobAddress();
                $receiver = [
                    'firstName' => $billingData['first_name'],
                    'lastName' => $billingData['last_name'],
                    'phone' => $billingData['phone_number'],
                    'email' => $billingData['email'],
                ];
            } else {
                $receiver = [
                    'firstName' => $validated['billing_address']['first_name'],
                    'lastName' => $validated['billing_address']['last_name'],
                    'phone' => $validated['billing_address']['phone'],
                    'email' => $validated['billing_address']['email'],
                ];
            }

            if ($shippingAddress) {
                $dropOffAddress = $shippingAddress->toBostaAddress();
            } else {
                $dropOffAddress = [
                    'buildingNumber' => $validated['shipping_address']['building_number'],
                    'firstLine' => $validated['shipping_address']['street'],
                    'city' => $validated['shipping_address']['city'],
                    'zone' => $validated['shipping_address']['zone'],
                    'floor' => $validated['shipping_address']['floor'] ?? null,
                    'apartment' => $validated['shipping_address']['apartment'] ?? null,
                ];
            }

            $shipmentPayload = [
                'type' => 10, // Required field for Bosta API - 10 = standard delivery
                'receiver' => $receiver,
                'dropOffAddress' => $dropOffAddress,
                'notes' => $validated['notes'] ?? '',
                'cod' => 0, // We're using online payment, no COD
            ];

            $shipmentResponse = $this->bostaService->createDelivery($shipmentPayload);

            if (! $shipmentResponse['success']) {
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
            if ($billingAddress) {
                $billingData = $billingAddress->toPaymobAddress();
            } else {
                $billingData = [
                    'first_name' => $validated['billing_address']['first_name'],
                    'last_name' => $validated['billing_address']['last_name'],
                    'email' => $validated['billing_address']['email'],
                    'phone_number' => $validated['billing_address']['phone'],
                    'street' => $validated['billing_address']['street'],
                    'building' => $validated['billing_address']['street'],
                    'floor' => $validated['billing_address']['floor'] ?? 'NA',
                    'apartment' => $validated['billing_address']['apartment'] ?? 'NA',
                    'city' => $validated['billing_address']['city'],
                    'country' => $validated['billing_address']['country'],
                    'postal_code' => $validated['billing_address']['zip_code'],
                    'state' => 'NA',
                    'shipping_method' => 'NA',
                ];
            }

            $paymentData = [
                'amount_cents' => intval($summary['total'] * 100), // Convert to cents
                'currency' => 'EGP',
                'order_id' => 'TEMP-' . time(), // Temporary order ID
                'billing_data' => $billingData,
            ];

            \Log::info('Checkout: Initiating payment', [
                'paymentData' => $paymentData,
                'cart_summary' => $summary,
            ]);

            $paymentResponse = $this->paymentGateway->sendPayment(new Request($paymentData));

            \Log::info('Checkout: Payment response', ['response' => $paymentResponse]);

            if (! $paymentResponse['success']) {
                // Clean up shipment if payment fails
                // Note: In a real implementation, you might want to cancel the shipment
                return response()->json([
                    'success' => false,
                    'message' => 'Payment initiation failed',
                    'error' => $paymentResponse['message'] ?? 'Payment error',
                ], 422);
            }

            // Store order data in database for payment completion
            \Log::info('Storing pending checkout', [
                'session_id' => session()->getId(),
                'temp_order_id' => $paymentResponse['order_id'],
                'payment_response' => $paymentResponse,
            ]);

            PendingCheckout::create([
                'session_id' => session()->getId(),
                'temp_order_id' => $paymentResponse['order_id'],
                'order_data' => $orderData,
                'shipment_data' => [
                    'tracking_number' => $shipmentResponse['data']['trackingNumber'],
                    'status' => $shipmentResponse['data']['state']['value'] ?? 'pending',
                ],
                'expires_at' => now()->addHours(24), // Expire after 24 hours for debugging
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Checkout initiated successfully',
                'data' => [
                    'payment_key' => $paymentResponse['payment_key'],
                    'iframe_url' => $paymentResponse['iframe_url'],
                    'temp_order_id' => $paymentResponse['order_id'],
                    'tracking_number' => $shipmentResponse['data']['trackingNumber'],
                    'cost_breakdown' => [
                        'subtotal' => $summary['subtotal'],
                        'tax' => $summary['tax'],
                        'shipping' => $summary['shipping'],
                        'total' => $summary['total'],
                        'item_count' => $summary['item_count'],
                    ],
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Checkout failed: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Complete checkout
     *
     * Finalize the checkout process after successful payment.
     * This endpoint is called by the payment gateway callback or webhook.
     * It creates the final order, processes the shipment, and clears the cart.
     *
     * @unauthenticated
     *
     * @queryParam order_id string The temporary order ID from the checkout initiation. Example: chk_abc123
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Order created successfully",
     *   "data": {
     *     "order_id": 1,
     *     "order_number": "ORD-2024-001",
     *     "status": "processing",
     *     "payment_status": "paid",
     *     "total_amount": 164.00,
     *     "tracking_number": "BOSTA123456"
     *   }
     * }
     * @response 400 scenario="Order ID Required" {
     *   "success": false,
     *   "message": "Order ID is required"
     * }
     * @response 404 scenario="Checkout Not Found" {
     *   "success": false,
     *   "message": "Checkout session not found or expired"
     * }
     */
    public function complete(Request $request): JsonResponse
    {
        try {
            // For GET requests (redirects), get order_id from session or request
            // For POST requests (webhooks), get order_id from request
            $tempOrderId = $request->input('order_id');

            \Log::info('Checkout complete called', [
                'method' => $request->method(),
                'temp_order_id' => $tempOrderId,
                'all_input' => $request->all(),
            ]);

            // If order_id is not provided, try to find the most recent pending checkout for this session
            if (! $tempOrderId) {
                $sessionId = session()->getId();
                $allPendingForSession = PendingCheckout::where('session_id', $sessionId)->get();
                $activePendingForSession = PendingCheckout::where('session_id', $sessionId)->active()->get();

                \Log::info('Looking for pending checkout by session', [
                    'session_id' => $sessionId,
                    'all_pending_count' => $allPendingForSession->count(),
                    'active_pending_count' => $activePendingForSession->count(),
                    'all_pending_ids' => $allPendingForSession->pluck('id'),
                    'active_pending_ids' => $activePendingForSession->pluck('id'),
                    'current_time' => now(),
                    'expires_ats' => $allPendingForSession->pluck('expires_at'),
                ]);

                $pendingCheckout = PendingCheckout::where('session_id', $sessionId)
                    ->active()
                    ->latest()
                    ->first();

                if ($pendingCheckout) {
                    $tempOrderId = $pendingCheckout->temp_order_id;
                    \Log::info('Using fallback order_id from session', [
                        'fallback_order_id' => $tempOrderId,
                        'pending_checkout_id' => $pendingCheckout->id,
                        'session_id' => $sessionId,
                    ]);
                } else {
                    \Log::error('Checkout complete: No order_id provided and no active pending checkout found', [
                        'session_id' => $sessionId,
                        'all_pending_checkouts' => PendingCheckout::all()->map(function ($pc) {
                            return [
                                'id' => $pc->id,
                                'session_id' => $pc->session_id,
                                'temp_order_id' => $pc->temp_order_id,
                                'expires_at' => $pc->expires_at,
                                'is_active' => $pc->expires_at > now(),
                            ];
                        }),
                    ]);

                    return response()->json([
                        'success' => false,
                        'message' => 'Order ID is required',
                    ], 400);
                }
            }

            $pendingCheckout = PendingCheckout::where('temp_order_id', $tempOrderId)
                ->active() // Only non-expired
                ->first();

            \Log::info('Pending checkout lookup result', [
                'temp_order_id' => $tempOrderId,
                'found' => ! empty($pendingCheckout),
                'checkout_id' => $pendingCheckout ? $pendingCheckout->id : null,
                'expires_at' => $pendingCheckout ? $pendingCheckout->expires_at : null,
                'total_pending_checkouts' => PendingCheckout::count(),
            ]);

            if (! $pendingCheckout) {
                \Log::error('Checkout complete: No pending checkout found', [
                    'temp_order_id' => $tempOrderId,
                    'all_pending_checkouts' => PendingCheckout::all()->pluck('temp_order_id')->toArray(),
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'No pending checkout found',
                ], 404);
            }

            $pendingOrderData = $pendingCheckout->order_data;
            $pendingShipmentData = $pendingCheckout->shipment_data;

            // Get payment_id from request (available for both GET and POST)
            $paymentId = $request->input('payment_id');

            // For GET requests (redirects), payment success is already validated
            // For POST requests (webhooks), validate payment success from request
            if ($request->isMethod('post')) {
                $paymentSuccess = $request->input('success', false);

                if (! $paymentSuccess) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment was not successful',
                    ], 422);
                }
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

            // Clean up the pending checkout data
            $pendingCheckout->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => $order->load('items.product'),
            ]);

        } catch (\Exception $e) {
            \Log::error('Order creation failed with real data', [
                'temp_order_id' => $tempOrderId,
                'pending_checkout_id' => $pendingCheckout ? $pendingCheckout->id : null,
                'order_data_keys' => $pendingCheckout ? array_keys($pendingCheckout->order_data) : null,
                'shipment_data_keys' => $pendingCheckout ? array_keys($pendingCheckout->shipment_data) : null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Order creation failed: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Handle checkout failure
     *
     * Handle failed checkout due to payment or shipment failure.
     * Clears pending checkout data and redirects or returns error response.
     *
     * @unauthenticated
     *
     * @queryParam error string The error message from the payment gateway. Example: Payment declined
     *
     * @response 200 scenario="API Response" {
     *   "success": false,
     *   "message": "Checkout failed",
     *   "error": "Payment declined"
     * }
     */
    public function fail(Request $request)
    {
        // Clear session data
        session()->forget(['pending_order_data', 'pending_shipment_data']);

        // Also clear any pending checkout data from database
        PendingCheckout::where('session_id', session()->getId())->delete();

        // For web requests (redirects), redirect to payment failed page
        if (! $request->expectsJson() || $request->isMethod('get')) {
            return redirect('/payment-failed');
        }

        // For API requests, return JSON
        return response()->json([
            'success' => false,
            'message' => 'Checkout failed',
            'error' => $request->input('error', 'Unknown error'),
        ]);
    }

    /**
     * Get checkout status
     *
     * Check if there's a pending checkout session and get current cart summary.
     * Useful for resuming interrupted checkout flows.
     *
     * @unauthenticated
     *
     * @response 200 scenario="Has Pending Checkout" {
     *   "success": true,
     *   "data": {
     *     "has_pending_checkout": true,
     *     "cart_summary": {
     *       "subtotal": 100.00,
     *       "tax": 14.00,
     *       "shipping": 50.00,
     *       "total": 164.00,
     *       "item_count": 3
     *     },
     *     "cart_items_count": 3
     *   }
     * }
     * @response 200 scenario="No Pending Checkout" {
     *   "success": true,
     *   "data": {
     *     "has_pending_checkout": false,
     *     "cart_summary": {
     *       "subtotal": 0.00,
     *       "tax": 0.00,
     *       "shipping": 0.00,
     *       "total": 0.00,
     *       "item_count": 0
     *     },
     *     "cart_items_count": 0
     *   }
     * }
     */
    public function status(Request $request): JsonResponse
    {
        $pendingOrderData = session('pending_order_data');
        $pendingShipmentData = session('pending_shipment_data');

        // Also check database for pending checkout
        $pendingCheckout = PendingCheckout::where('session_id', session()->getId())
            ->active()
            ->first();

        $hasPendingCheckout = ! empty($pendingOrderData) || ! empty($pendingCheckout);

        return response()->json([
            'success' => true,
            'data' => [
                'has_pending_checkout' => $hasPendingCheckout,
                'cart_summary' => $this->cartService->getSummary(),
                'cart_items_count' => $this->cartService->getItemCount(),
            ],
        ]);
    }

    /**
     * Test checkout completion
     *
     * Test endpoint to complete checkout with real pending checkout data.
     * This is useful for testing the checkout flow without going through payment.
     *
     * @unauthenticated
     *
     * @response 200 scenario="Success" {
     *   "success": true,
     *   "message": "Test order created successfully",
     *   "data": {
     *     "id": 1,
     *     "order_number": "ORD-2024-001",
     *     "status": "processing",
     *     "payment_status": "paid"
     *   }
     * }
     * @response 404 scenario="No Pending Checkout" {
     *   "success": false,
     *   "message": "No active pending checkout found for testing"
     * }
     */
    public function testComplete(Request $request): JsonResponse
    {
        try {
            // Get the first pending checkout for testing
            $pendingCheckout = PendingCheckout::active()->first();

            if (! $pendingCheckout) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active pending checkout found for testing',
                ], 404);
            }

            \Log::info('Testing checkout complete with real data', [
                'pending_checkout_id' => $pendingCheckout->id,
                'temp_order_id' => $pendingCheckout->temp_order_id,
                'order_data_keys' => array_keys($pendingCheckout->order_data),
                'shipment_data_keys' => array_keys($pendingCheckout->shipment_data),
                'order_data_sample' => array_slice($pendingCheckout->order_data, 0, 3),
                'shipment_data_sample' => $pendingCheckout->shipment_data,
            ]);

            // Create a test request with the temp_order_id
            $testRequest = new Request([
                'order_id' => $pendingCheckout->temp_order_id,
                'payment_id' => 'TEST-PAYMENT-'.time(),
            ]);

            // Call the actual complete method
            return $this->complete($testRequest);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Test failed: '.$e->getMessage(),
            ], 500);
        }
    }
}
