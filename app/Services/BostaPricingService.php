<?php

namespace App\Services;

class BostaPricingService
{
    protected array $pricing;
    protected array $zones;
    protected array $packageSizes;
    protected array $defaults;

    public function __construct()
    {
        $this->pricing = config('bosta.pricing', []);
        $this->zones = config('bosta.zones', []);
        $this->packageSizes = config('bosta.package_sizes', []);
        $this->defaults = config('bosta.defaults', []);
    }

    /**
     * Calculate shipping cost based on zone and package size
     */
    public function calculateShippingCost(string $city, string $packageSize = null, float $subtotal = 0): float
    {
        // Check for free shipping threshold
        // if ($subtotal >= $this->defaults['free_shipping_threshold']) {
        //     return 0.0;
        // }

        $zone = $this->getZoneFromCity($city);
        $size = $packageSize ?: $this->defaults['size'];

        $cost = $this->pricing[$zone][$size] ?? $this->pricing[$this->defaults['zone']][$this->defaults['size']];

        // Add VAT if configured
        if ($this->defaults['include_vat']) {
            $cost *= (1 + $this->defaults['vat_rate']);
        }

        return round($cost, 2);
    }

    /**
     * Determine delivery zone from city name
     */
    public function getZoneFromCity(string $city): string
    {
        $city = strtolower(trim($city));

        foreach ($this->zones as $zone => $cities) {
            if (in_array($city, array_map('strtolower', $cities))) {
                return $zone;
            }
        }

        return $this->defaults['zone'];
    }

    /**
     * Determine package size based on order items
     */
    public function determinePackageSize(array $cartItems): string
    {
        $totalWeight = 0;
        $maxDimension = 0;

        foreach ($cartItems as $productId => $quantity) {
            $product = \App\Models\Product::find($productId);
            if ($product) {
                // Assuming products have weight and dimensions
                // For now, use simple logic based on quantity and price
                $totalWeight += $quantity * 0.5; // Assume 0.5kg per item
                $maxDimension = max($maxDimension, $quantity * 10); // Assume 10cm per item
            }
        }

        if ($totalWeight >= $this->packageSizes['heavy_bulky']['min_weight'] ||
            $maxDimension >= $this->packageSizes['heavy_bulky']['min_dimension']) {
            return 'heavy_bulky';
        }

        if ($totalWeight >= $this->packageSizes['light_bulky']['max_weight'] ||
            $maxDimension >= $this->packageSizes['light_bulky']['max_dimension']) {
            return 'light_bulky';
        }

        return 'small_medium';
    }

    /**
     * Get all available zones
     */
    public function getZones(): array
    {
        return array_keys($this->zones);
    }

    /**
     * Get pricing for a specific zone
     */
    public function getZonePricing(string $zone): array
    {
        return $this->pricing[$zone] ?? [];
    }

    /**
     * Check if free shipping applies
     */
    public function isFreeShipping(float $subtotal): bool
    {
        return $subtotal >= $this->defaults['free_shipping_threshold'];
    }
}
