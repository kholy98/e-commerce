<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BostaApiService
{
    protected $apiKey;

    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = \App\Models\Setting::get('BOSTA_API_KEY', config('services.bosta.api_key'));
        $this->baseUrl = \App\Models\Setting::get('BOSTA_BASE_URL', config('services.bosta.base_url'));
    }

    // Helper for authenticated requests
    protected function makeRequest($method, $endpoint, $data = [])
    {
        $response = Http::withHeaders([
            'Authorization' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->{$method}($this->baseUrl.$endpoint, $data);

        if ($response->failed()) {
            throw new \Exception('Bosta API Error: '.$response->body());
        }

        return $response->json();
    }

    // Create shipment
    public function createDelivery(array $data)
    {
        return $this->makeRequest('post', '/deliveries', $data);
    }

    // Track shipment
    public function getDelivery($trackingNumber)
    {
        return $this->makeRequest('get', "/deliveries/business/{$trackingNumber}");
    }

    // Update delivery by tracking number
    public function updateDelivery($trackingNumber, array $data)
    {
        return $this->makeRequest('put', "/deliveries/business/{$trackingNumber}", $data);
    }

    // Create pickup
    public function createPickup(array $data)
    {
        return $this->makeRequest('post', '/pickups', $data);
    }

    // Cancel delivery using terminate endpoint
    public function cancelDelivery($trackingNumber)
    {
        // Use the dedicated terminate endpoint for proper cancellation
        return $this->makeRequest('delete', "/deliveries/business/{$trackingNumber}/terminate");
    }

    // Legacy method - cancel delivery using state update (deprecated)
    public function cancelDeliveryByState($trackingNumber)
    {
        // According to Bosta API, you can update the delivery state to cancelled
        return $this->updateDelivery($trackingNumber, [
            'state' => 49, // cancelled state
        ]);
    }
}
