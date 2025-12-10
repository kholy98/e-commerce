<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymobPaymentService extends BasePaymentService implements PaymentGatewayInterface
{
    protected $api_key;
    protected $integrations_id;
    protected $integration_id;
    protected $iframe_id; // Iframe ID for URL construction

    public function __construct()
    {
        $this->base_url = env("PAYMOB_BASE_URL");
        $this->api_key = env("PAYMOB_API_KEY");
        $this->integration_id = env("PAYMOB_INTEGRATION_ID");
        $this->iframe_id = env("PAYMOB_IFRAME_ID");

        $this->header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        // Iframe integration IDs
        $this->integrations_id = env("PAYMOB_INTEGRATIONS_ID", [5425213]);
    }

    /**
     * Generate authentication token from Paymob API
     */
    protected function generateToken(): string
    {
        $response = $this->buildRequest('POST', '/api/auth/tokens', ['api_key' => $this->api_key]);
        return $response->getData(true)['data']['token'];
    }

    /**
     * Create an order in Paymob system
     */
    protected function createOrder(array $orderData): array
    {
        $auth_token = $this->generateToken();
        $this->header['Authorization'] = 'Bearer ' . $auth_token;

        $orderData['api_source'] = "INVOICE";
        $orderData['integrations'] = is_string($this->integrations_id)
            ? json_decode($this->integrations_id)
            : $this->integrations_id;

        $response = $this->buildRequest('POST', '/api/ecommerce/orders', $orderData);

        if (!$response->getData(true)['success']) {
            return [
                'success' => false,
                'message' => 'Failed to create order',
                'error' => $response->getData(true)
            ];
        }

        return [
            'success' => true,
            'auth_token' => $auth_token,
            'order_id' => $response->getData(true)['data']['id'],
            'order_data' => $response->getData(true)['data'],
        ];
    }

    /**
     * Generate payment key for iframe integration
     */
    public function generatePaymentKey(array $paymentData): array
    {
        try {
            $response = $this->buildRequest(
                'POST',
                '/api/acceptance/payment_keys',
                $paymentData,
                'json'
            );
            

            if (!$response->getData(true)['success']) {
                return [
                    'success' => false,
                    'message' => 'Failed to generate payment key',
                    'error' => $response->getData(true)
                ];
            }

            $payment_token = $response->getData(true)['data']['token'];


            return [
                'success' => true,
                'payment_key' => $payment_token,
                'iframe_url' => 'https://accept.paymob.com/api/acceptance/iframes/' . $this->iframe_id . '?payment_token=' . $payment_token
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Payment key generation failed',
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Process payment request - creates order and generates payment key
     */
    public function sendPayment(Request $request): array
    {
        $orderData = $request->all();

        // Create order first
        $orderResponse = $this->createOrder($orderData);



        if (!$orderResponse['success']) {
            return [
                'success' => false,
                'message' => $orderResponse['message'],
                'url' => route('payment.failed')
            ];
        }

        // Prepare billing data from request
        $billingData = $request->input('billing_data', []);

        // Generate payment key
        $paymentKeyData = [
            'auth_token' => $orderResponse['auth_token'],
            'amount_cents' => $request->input('amount_cents'),
            'expiration' => 3600,
            'order_id' => $orderResponse['order_id'],
            'billing_data' => $billingData,
            'currency' => $request->input('currency', 'EGP'),
            'integration_id' => $this->integration_id,
        ];


        $paymentKeyResponse = $this->generatePaymentKey($paymentKeyData);

        if (!$paymentKeyResponse['success']) {
            return [
                'success' => false,
                'message' => $paymentKeyResponse['message'],
                'url' => route('payment.failed')
            ];
        }

        return [
            'success' => true,
            'payment_key' => $paymentKeyResponse['payment_key'],
            'iframe_url' => $paymentKeyResponse['iframe_url'],
            'order_id' => $orderResponse['order_id'],
        ];
    }

    /**
     * Handle payment callback
     */
    public function callBack(Request $request): bool
    {
        $response = $request->all();
        Storage::put('paymob_response.json', json_encode($request->all()));

        return isset($response['success']) && $response['success'] === 'true';
    }
}
