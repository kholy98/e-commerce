<?php

namespace App\Http\Controllers;

use App\Interfaces\PaymentGatewayInterface;
use App\Services\SessionCartService;
use App\Services\OrderService;
use App\Services\BostaApiService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected PaymentGatewayInterface $paymentGateway;

    public function __construct(PaymentGatewayInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * Process payment and return payment key/iframe URL
     */
    public function paymentProcess(Request $request)
    {
        $response = $this->paymentGateway->sendPayment($request);

        if (!$response['success']) {
            return response()->json([
                'success' => false,
                'message' => $response['message'] ?? 'Payment processing failed',
                'url' => $response['url'] ?? route('payment.failed')
            ], 400);
        }

        // Return payment key and iframe URL for frontend
        return response()->json([
            'success' => true,
            'payment_key' => $response['payment_key'],
            'iframe_url' => $response['iframe_url'],
            'order_id' => $response['order_id'],
        ]);
    }

    /**
     * Handle payment callback from Paymob
     */
    public function callBack(Request $request): \Illuminate\Http\JsonResponse
    {
        \Log::info('Payment callback received', [
            'all_params' => $request->all(),
            'method' => $request->method(),
            'headers' => $request->headers->all()
        ]);

        $callbackData = $this->paymentGateway->callBack($request);

        // Get tracking number from pending checkout if available
        $trackingNumber = null;
        if ($callbackData['order_id']) {
            $pendingCheckout = \App\Models\PendingCheckout::where('temp_order_id', $callbackData['order_id'])
                ->active()
                ->first();

            if ($pendingCheckout && isset($pendingCheckout->shipment_data['tracking_number'])) {
                $trackingNumber = $pendingCheckout->shipment_data['tracking_number'];
            }
        }

        if (!$callbackData['success'] && $trackingNumber) {
            // Cancel shipment if payment failed
            try {
                $bostaService = app(\App\Services\BostaApiService::class);
                $cancelResult = $bostaService->cancelDelivery($trackingNumber);

                \Log::info('Shipment cancelled due to payment failure', [
                    'tracking_number' => $trackingNumber,
                    'cancel_result' => $cancelResult
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to cancel shipment', [
                    'tracking_number' => $trackingNumber,
                    'error' => $e->getMessage()
                ]);
            }
        }

        \Log::info('Payment callback processed', [
            'success' => $callbackData['success'],
            'order_id' => $callbackData['order_id'],
            'payment_id' => $callbackData['payment_id'],
            'tracking_number' => $trackingNumber
        ]);

        return response()->json([
            'success' => $callbackData['success'],
            'payment_status' => $callbackData['success'] ? 'paid' : 'failed',
            'order_id' => $callbackData['order_id'],
            'payment_id' => $callbackData['payment_id'],
            'tracking_number' => $trackingNumber
        ]);
    }

    /**
     * Handle payment webhook from Paymob
     */
    public function webhook(Request $request): JsonResponse
    {
        try {
            $payload = $request->all();
            
            // Log webhook for debugging
            Log::info('Paymob webhook received', $payload);

            // Extract payment information
            $transactionId = $payload['obj']['id'] ?? null;
            $success = $payload['obj']['success'] ?? false;
            $orderId = $payload['obj']['order']['id'] ?? null;
            $amount = $payload['obj']['amount_cents'] ?? 0;

            \Log::info('Paymob webhook data extraction', [
                'transaction_id' => $transactionId,
                'success' => $success,
                'order_id' => $orderId,
                'order_id_type' => gettype($orderId),
                'amount' => $amount,
                'payload_keys' => array_keys($payload),
                'obj_keys' => isset($payload['obj']) ? array_keys($payload['obj']) : [],
                'order_keys' => isset($payload['obj']['order']) ? array_keys($payload['obj']['order']) : [],
                'full_order_data' => $payload['obj']['order'] ?? null
            ]);

            if ($success && $transactionId && $orderId) {
                // Call checkout completion
                $checkoutController = app(CheckoutController::class);

                $completeRequest = new Request([
                    'success' => true,
                    'payment_id' => $transactionId,
                    'order_id' => $orderId,
                    'amount' => $amount / 100, // Convert back to currency
                ]);

                return $checkoutController->complete($completeRequest);
            } else {
                // Payment failed
                $checkoutController = app(CheckoutController::class);

                $failRequest = new Request([
                    'success' => false,
                    'error' => 'Payment failed',
                    'payment_id' => $transactionId,
                ]);

                return $checkoutController->fail($failRequest);
            }

        } catch (\Exception $e) {
            Log::error('Paymob webhook error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Webhook processing failed',
            ], 500);
        }
    }

    /**
     * Payment success page
     */
    public function success()
    {
        return view('payment-success');
    }

    /**
     * Payment failed page
     */
    public function failed()
    {
        return view('payment-failed');
    }
}
