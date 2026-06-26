<?php

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

test('login is rate limited after too many failed attempts', function () {
    $user = User::factory()->create([
        'password' => bcrypt('correct-password')
    ]);

    // Laravel Breeze default limit is 5 attempts per minute.
    for ($i = 0; $i < 5; $i++) {
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
    }

    // The 6th attempt should hit the rate limiter or bot protection
    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
    
    // Check if the specific rate limit or bot error message is present
    $errors = session('errors')->all();
    
    // Assert that the error array contains a string related to rate limiting or bot protection
    $hasProtectionError = false;
    foreach ($errors as $error) {
        $errorLower = strtolower($error);
        if (str_contains($errorLower, 'too many') || str_contains($errorLower, 'seconds') || str_contains($error, 'บอท')) {
            $hasProtectionError = true;
            break;
        }
    }
    
    expect($hasProtectionError)->toBeTrue();
});
