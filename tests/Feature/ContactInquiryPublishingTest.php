<?php

use App\Models\ContactInquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

pest()->extend(Tests\TestCase::class)
    ->use(RefreshDatabase::class)
    ->in(__DIR__);

it('allows admin to publish replied inquiry', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $inquiry = ContactInquiry::factory()->replied()->create(['is_published' => false]);

    $response = $this->actingAs($admin)
        ->post(route('admin.inquiries.publish', $inquiry));

    $response->assertRedirect();
    expect($inquiry->fresh()->is_published)->toBeTrue();
});

it('prevents admin from publishing pending inquiry', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $inquiry = ContactInquiry::factory()->pending()->create(['is_published' => false]);

    $response = $this->actingAs($admin)
        ->post(route('admin.inquiries.publish', $inquiry));

    $response->assertRedirect();
    $response->assertSessionHas('error', 'Only replied inquiries can be published.');
    expect($inquiry->fresh()->is_published)->toBeFalse();
});

it('returns only published inquiries on public endpoint', function () {
    $publishedInquiry = ContactInquiry::factory()->published()->create();
    $repliedButUnpublished = ContactInquiry::factory()->replied()->create(['is_published' => false]);
    $pendingInquiry = ContactInquiry::factory()->pending()->create(['is_published' => false]);

    $response = $this->getJson(route('api.contact-inquiries.published'));

    $response->assertSuccessful();
    $response->assertJsonCount(1, 'data');
    $response->assertJsonPath('data.0.full_name', $publishedInquiry->full_name);
});

it('excludes sensitive fields from public endpoint response', function () {
    ContactInquiry::factory()->published()->create([
        'full_name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '+1234567890',
        'company' => 'Acme Inc',
        'message' => 'Test message',
        'reply_message' => 'Test reply',
    ]);

    $response = $this->getJson(route('api.contact-inquiries.published'));

    $response->assertSuccessful();

    $firstItem = $response->json('data.0');

    // Fields that should be present
    expect($firstItem)->toHaveKey('full_name');
    expect($firstItem)->toHaveKey('company');
    expect($firstItem)->toHaveKey('message');
    expect($firstItem)->toHaveKey('reply_message');
    expect($firstItem)->toHaveKey('created_at');

    // Sensitive fields that should NOT be present
    expect($firstItem)->not->toHaveKey('email');
    expect($firstItem)->not->toHaveKey('phone');
    expect($firstItem)->not->toHaveKey('id');
});

it('allows admin to unpublish inquiry', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $inquiry = ContactInquiry::factory()->published()->create(['is_published' => true]);

    $response = $this->actingAs($admin)
        ->post(route('admin.inquiries.publish', $inquiry));

    $response->assertRedirect();
    $response->assertSessionHas('success', 'Inquiry unpublished successfully.');
    expect($inquiry->fresh()->is_published)->toBeFalse();
});
