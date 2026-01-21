<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ApiDocumentationTest extends TestCase
{
    /**
     * Test that the HTML documentation page is served.
     */
    public function test_serves_the_html_documentation_page(): void
    {
        $response = $this->get('/docs');

        $response->assertStatus(200);
    }

    /**
     * Test that the OpenAPI specification endpoint is accessible.
     */
    public function test_serves_the_openapi_specification(): void
    {
        $response = $this->get('/docs.openapi');

        $response->assertStatus(200);
    }

    /**
     * Test that the Postman collection endpoint is accessible.
     */
    public function test_serves_the_postman_collection(): void
    {
        $response = $this->get('/docs.postman');

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('info', $content);
        $this->assertArrayHasKey('item', $content);
        $this->assertArrayHasKey('name', $content['info']);
    }

    /**
     * Test that the OpenAPI file is generated in storage.
     */
    public function test_has_openapi_file_generated_in_storage(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');

        $this->assertTrue(File::exists($path), 'OpenAPI file should exist at: '.$path);

        $content = File::get($path);
        $this->assertStringContainsString('openapi: 3.0.3', $content);
        $this->assertStringContainsString('securitySchemes:', $content);
    }

    /**
     * Test that the Postman collection file is generated in storage.
     */
    public function test_has_postman_collection_file_generated_in_storage(): void
    {
        $path = storage_path('app/private/scribe/collection.json');

        $this->assertTrue(File::exists($path), 'Postman collection file should exist at: '.$path);

        $content = json_decode(File::get($path), true);
        $this->assertIsArray($content);
        $this->assertArrayHasKey('info', $content);
        $this->assertArrayHasKey('item', $content);
    }

    /**
     * Test that the OpenAPI spec includes authentication security scheme.
     */
    public function test_includes_authentication_security_scheme_in_openapi_spec(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');
        $content = File::get($path);

        $this->assertStringContainsString('securitySchemes:', $content);
        $this->assertStringContainsString('type: http', $content);
        $this->assertStringContainsString('scheme: bearer', $content);
    }

    /**
     * Test that all expected API groups are documented.
     */
    public function test_documents_all_expected_api_groups(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');
        $content = File::get($path);

        $expectedGroups = [
            'Authentication',
            'Products',
            'Categories',
            'Cart',
            'Checkout',
            'Orders',
            'Wishlist',
        ];

        foreach ($expectedGroups as $group) {
            $this->assertStringContainsString("name: {$group}", $content, "API group '{$group}' should be documented");
        }
    }

    /**
     * Test that authenticated endpoints for Orders are documented.
     */
    public function test_documents_authenticated_endpoints_for_orders(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');
        $content = File::get($path);

        $this->assertStringContainsString('/api/orders:', $content);
        $this->assertStringContainsString('List all orders', $content);
        $this->assertStringContainsString('Get order details', $content);
    }

    /**
     * Test that authenticated endpoints for Wishlist are documented.
     */
    public function test_documents_authenticated_endpoints_for_wishlist(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');
        $content = File::get($path);

        $this->assertStringContainsString('/api/wishlist:', $content);
        $this->assertStringContainsString('List wishlist items', $content);
        $this->assertStringContainsString('Add to wishlist', $content);
    }

    /**
     * Test that public endpoints for Products are documented.
     */
    public function test_documents_public_endpoints_for_products(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');
        $content = File::get($path);

        $this->assertStringContainsString('/api/products:', $content);
        $this->assertStringContainsString('List all products', $content);
        $this->assertStringContainsString('Get product details', $content);
    }

    /**
     * Test that public endpoints for Cart are documented.
     */
    public function test_documents_public_endpoints_for_cart(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');
        $content = File::get($path);

        $this->assertStringContainsString('/api/cart:', $content);
        $this->assertStringContainsString('Get cart items', $content);
        $this->assertStringContainsString('Add item to cart', $content);
    }

    /**
     * Test that the API description is included in OpenAPI spec.
     */
    public function test_includes_api_description_in_openapi_spec(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');
        $content = File::get($path);

        $this->assertStringContainsString('E-commerce API for managing products, categories, cart, orders, and more.', $content);
    }

    /**
     * Test that version information is included in OpenAPI spec.
     */
    public function test_includes_version_information_in_openapi_spec(): void
    {
        $path = storage_path('app/private/scribe/openapi.yaml');
        $content = File::get($path);

        $this->assertStringContainsString('version: 1.0.0', $content);
    }
}
