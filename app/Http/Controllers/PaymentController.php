<?php

namespace App\Http\Controllers;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;

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

        return redirect()->route(
            $response ? 'payment.success' : 'payment.failed'
        );
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
