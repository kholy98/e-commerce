<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    private ?string $accountSid;

    private ?string $authToken;

    private ?string $fromPhone;

    private ?string $metaApiKey;

    private ?string $metaPhoneNumberId;

    private ?string $baseUrl;

    private bool $useTwilio;

    public function __construct()
    {
        $this->accountSid = config('services.whatsapp.account_sid');
        $this->authToken = config('services.whatsapp.auth_token');
        $this->fromPhone = config('services.whatsapp.phone_number');
        $this->metaApiKey = config('services.whatsapp.api_key');
        $this->metaPhoneNumberId = config('services.whatsapp.phone_number_id');
        $this->baseUrl = config('services.whatsapp.base_url');

        $this->useTwilio = ! empty($this->accountSid) && ! empty($this->authToken) && ! empty($this->fromPhone);
    }

    public function isConfigured(): bool
    {
        return $this->useTwilio || (! empty($this->metaApiKey) && ! empty($this->metaPhoneNumberId));
    }

    public function sendOrderNotification(Order $order): bool
    {
        if (! $this->isConfigured()) {
            Log::info('WhatsApp notification skipped - not configured');

            return false;
        }

        $phoneNumber = $this->getCustomerPhone($order);
        if (empty($phoneNumber)) {
            Log::warning('WhatsApp notification skipped - no phone number', ['order_id' => $order->id]);

            return false;
        }

        $message = $this->formatOrderMessage($order);

        return $this->sendMessage($phoneNumber, $message);
    }

    public function sendSupplierNotification(Order $order, User $supplier, array $items): bool
    {
        if (! $this->isConfigured()) {
            Log::info('WhatsApp supplier notification skipped - not configured');

            return false;
        }

        $phoneNumber = $supplier->phone;
        if (empty($phoneNumber)) {
            Log::warning('WhatsApp supplier notification skipped - no phone number', [
                'order_id' => $order->id,
                'supplier_id' => $supplier->id,
            ]);

            return false;
        }

        $message = $this->formatSupplierMessage($order, $supplier, $items);

        return $this->sendMessage($phoneNumber, $message);
    }

    private function formatSupplierMessage(Order $order, User $supplier, array $items): string
    {
        $customerName = $this->getCustomerName($order);
        $itemsList = $this->formatItemsList($items);

        $message = "Hello {$supplier->name}! \n\n";
        $message .= "You have a new order! \n\n";
        $message .= "Order Number: #{$order->order_number} \n";
        $message .= "Customer: {$customerName} \n";
        $message .= "Shipping Address: \n".$this->getShippingAddress($order)." \n\n";
        $message .= "Your Items: \n{$itemsList} \n\n";
        $message .= 'Please prepare these items for shipment.';

        return $message;
    }

    private function formatItemsList(array $items): string
    {
        $formatted = [];
        foreach ($items as $item) {
            $formatted[] = "- {$item['product_name']} (Qty: {$item['quantity']})";
        }

        return implode("\n", $formatted);
    }

    private function getCustomerPhone(Order $order): ?string
    {
        if ($order->user && $order->user->phone) {
            return $order->user->phone;
        }

        $billingAddress = $order->billing_address;
        if ($billingAddress && ! empty($billingAddress['phone'])) {
            return $billingAddress['phone'];
        }

        return null;
    }

    private function formatOrderMessage(Order $order): string
    {
        $customerName = $this->getCustomerName($order);
        $itemsList = $this->getItemsList($order);

        $message = "Hello {$customerName}! \n\n";
        $message .= "Your order has been confirmed! \n\n";
        $message .= "Order Number: #{$order->order_number} \n";
        $message .= 'Status: '.ucfirst($order->status)." \n";
        $message .= 'Payment Method: '.($order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment')." \n\n";
        $message .= "Shipping Address: \n".$this->getShippingAddress($order)." \n\n";
        $message .= "Order Items: \n{$itemsList} \n\n";
        $message .= 'Thank you for your order!';

        return $message;
    }

    private function getCustomerName(Order $order): string
    {
        if ($order->user) {
            return $order->user->name;
        }

        $billingAddress = $order->billing_address;
        if ($billingAddress) {
            return trim(($billingAddress['first_name'] ?? '').' '.($billingAddress['last_name'] ?? ''));
        }

        return 'Customer';
    }

    private function getShippingAddress(Order $order): string
    {
        $address = $order->shipping_address;
        if (! $address) {
            return 'Not provided';
        }

        $parts = [];
        if (! empty($address['street'])) {
            $parts[] = $address['street'];
        }
        if (! empty($address['city'])) {
            $parts[] = $address['city'].($address['zip_code'] ? ', '.$address['zip_code'] : '');
        }
        if (! empty($address['country'])) {
            $parts[] = $address['country'];
        }

        return implode(', ', $parts) ?: 'Not provided';
    }

    private function getItemsList(Order $order): string
    {
        $items = [];
        foreach ($order->items as $item) {
            $productName = $item->product?->name ?? 'Deleted Product';
            $items[] = "- {$productName} (Qty: {$item->quantity})";
        }

        return implode("\n", $items);
    }

    private function sendMessage(string $phoneNumber, string $message): bool
    {
        try {
            if ($this->useTwilio) {
                return $this->sendTwilioMessage($phoneNumber, $message);
            }

            return $this->sendMetaMessage($phoneNumber, $message);
        } catch (\Exception $e) {
            Log::error('WhatsApp notification error', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    private function sendTwilioMessage(string $phoneNumber, string $message): bool
    {
        $formattedPhone = $this->formatPhoneNumberForTwilio($phoneNumber);
        $fromPhone = $this->formatPhoneNumberForTwilio($this->fromPhone);

        // Debug log - comment out after testing
        // Log::info('Twilio WhatsApp debug', [
        //     'to' => 'whatsapp:'.$formattedPhone,
        //     'from' => 'whatsapp:'.$fromPhone,
        // ]);

        $response = Http::withBasicAuth($this->accountSid, $this->authToken)
            ->asForm()
            ->post("https://api.twilio.com/2010-04-01/Accounts/{$this->accountSid}/Messages.json", [
                'From' => 'whatsapp:'.$fromPhone,
                'To' => 'whatsapp:'.$formattedPhone,
                'Body' => $message,
            ]);

        if ($response->successful()) {
            Log::info("WhatsApp notification sent via Twilio to {$phoneNumber}");

            return true;
        }

        Log::error('WhatsApp notification failed via Twilio', [
            'phone' => $phoneNumber,
            'status' => $response->status(),
            'response' => $response->body(),
        ]);

        return false;
    }

    private function sendMetaMessage(string $phoneNumber, string $message): bool
    {
        $formattedPhone = $this->formatPhoneNumber($phoneNumber);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->metaApiKey,
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/{$this->metaPhoneNumberId}/messages", [
            'messaging_product' => 'whatsapp',
            'to' => $formattedPhone,
            'type' => 'text',
            'text' => [
                'body' => $message,
            ],
        ]);

        if ($response->successful()) {
            Log::info("WhatsApp notification sent via Meta to {$phoneNumber}");

            return true;
        }

        Log::error('WhatsApp notification failed via Meta', [
            'phone' => $phoneNumber,
            'status' => $response->status(),
            'response' => $response->body(),
        ]);

        return false;
    }

    private function formatPhoneNumber(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($phone, '0')) {
            $phone = substr($phone, 1);
        }

        if (! str_starts_with($phone, '20')) {
            $phone = '20'.$phone;
        }

        return $phone;
    }

    private function formatPhoneNumberForTwilio(string $phone): string
    {
        // Remove all non-digit characters
        $digits = preg_replace('/[^0-9]/', '', $phone);

        // If it already starts with +, return as-is
        if (str_starts_with($phone, '+')) {
            return $phone;
        }

        // Egyptian number starting with 0 (like 01234567890)
        if (str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        // Already has country code 20
        if (str_starts_with($digits, '20')) {
            return '+'.$digits;
        }

        // Add country code 20 for Egyptian numbers (10, 11, 12, 15, etc.)
        if (str_starts_with($digits, '1') || str_starts_with($digits, '2')) {
            return '+20'.$digits;
        }

        // Default: just add +
        return '+'.$digits;
    }
}
