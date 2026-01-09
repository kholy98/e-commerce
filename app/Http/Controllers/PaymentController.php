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
    public function callBack(Request $request): \Illuminate\Http\RedirectResponse
    {
        $response = $this->paymentGateway->callBack($request);

        // For new checkout flow, redirect to completion
        if ($response) {
            return redirect()->route('checkout.complete');
        } else {
            return redirect()->route('checkout.fail');
        }
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
