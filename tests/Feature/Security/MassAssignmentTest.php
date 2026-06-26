<?php

use App\Models\User;

test('user cannot mass assign is_admin or roles during registration', function () {
    // If registration is enabled, simulate a malicious POST request
    // injecting fields that shouldn't be fillable
    $response = $this->post(route('register'), [
        'name' => 'Test Malicious',
        'email' => 'malicious@example.com',
        'password' => 'T3stP@ssw0rd!2026OmniManage',
        'password_confirmation' => 'T3stP@ssw0rd!2026OmniManage',
        'is_admin' => 1,
        'role' => 'super-admin'
    ]);

    // Registration should succeed and redirect (assuming Breeze defaults to redirecting to dashboard)
    $response->assertRedirect(route('dashboard', absolute: false));

    $user = User::where('email', 'malicious@example.com')->first();
    expect($user)->not->toBeNull();
    
    // Ensure the malicious attempt to assign a role failed
    expect($user->hasRole('super-admin'))->toBeFalse();
});
