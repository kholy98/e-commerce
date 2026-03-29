<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(public Order $order) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $customerName = $this->getCustomerName();
        $itemsList = $this->getItemsList();

        return (new MailMessage)
            ->subject("Order #{$this->order->order_number} - Confirmation")
            ->greeting("Hello {$customerName}!")
            ->line('Your order has been confirmed!')
            ->line("Order Number: #{$this->order->order_number}")
            ->line('Order Status: '.ucfirst($this->order->status))
            ->line('Payment Method: '.($this->order->payment_method === 'cod' ? 'Cash on Delivery' : 'Online Payment'))
            ->line($this->getShippingAddress())
            ->line($this->getShippingAddress())
            ->line('')
            ->line('Order Items:')
            ->line($itemsList)
            ->line('')
            ->line('Thank you for your order!')
            ->salutation('Best regards, '.config('app.name'));
    }

    private function getCustomerName(): string
    {
        if ($this->order->user) {
            return $this->order->user->name;
        }

        $billingAddress = $this->order->billing_address;
        if ($billingAddress) {
            return trim(($billingAddress['first_name'] ?? '').' '.($billingAddress['last_name'] ?? ''));
        }

        return 'Customer';
    }

    private function getShippingAddress(): string
    {
        $address = $this->order->shipping_address;
        if (! $address) {
            return '';
        }

        $parts = [];
        if (! empty($address['street'])) {
            $parts[] = $address['street'];
        }
        if (! empty($address['building_number'])) {
            $parts[] = 'Building: '.$address['building_number'];
        }
        if (! empty($address['floor'])) {
            $parts[] = 'Floor: '.$address['floor'];
        }
        if (! empty($address['apartment'])) {
            $parts[] = 'Apt: '.$address['apartment'];
        }
        if (! empty($address['zone'])) {
            $parts[] = 'Zone: '.$address['zone'];
        }
        if (! empty($address['city'])) {
            $parts[] = $address['city'].($address['zip_code'] ? ', '.$address['zip_code'] : '');
        }
        if (! empty($address['country'])) {
            $parts[] = $address['country'];
        }

        return 'Shipping Address: '.implode(', ', $parts);
    }

    private function getItemsList(): string
    {
        $items = [];
        foreach ($this->order->items as $item) {
            $productName = $item->product?->name ?? 'Deleted Product';
            $items[] = "- {$productName} (Qty: {$item->quantity})";
        }

        return implode("\n", $items);
    }
}
