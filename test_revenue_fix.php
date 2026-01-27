<?php

use Illuminate\Http\Request;

// Simple test script to verify the revenue chart fix
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Simulate a request to the revenue chart endpoint
$request = Request::create('/api/admin/dashboard/revenue?period=monthly', 'GET');

$controller = new \App\Http\Controllers\DashboardController();

try {
    $response = $controller->revenueChart();
    
    echo "✅ Revenue chart test passed!\n";
    echo "Status: " . $response->getStatusCode() . "\n";
    echo "Response: " . $response->getContent() . "\n";
} catch (Exception $e) {
    echo "❌ Revenue chart test failed: " . $e->getMessage() . "\n";
}