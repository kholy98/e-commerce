<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedForSupplierNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Order $order,
        public User $supplier,
        public array $supplierItems
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $customerName = $this->getCustomerName();
        $itemsList = $this->getItemsList();

        return (new MailMessage)
            ->subject("New Order #{$this->order->order_number} - You have new items to fulfill!")
            ->greeting("Hello {$notifiable->name}!")
            ->line('You have a new order containing your products!')
            ->line("Order Number: #{$this->order->order_number}")
            ->line("Customer Name: {$customerName}")
            ->line($this->getShippingAddress())
            ->line('')
            ->line('Your Items in this Order:')
            ->line($itemsList)
            ->line('')
            ->line('Please prepare these items for shipment.')
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
        foreach ($this->supplierItems as $item) {
            $productName = $item['product_name'];
            $items[] = "- {$productName} (Qty: {$item['quantity']})";
        }

        return implode("\n", $items);
    }
}
