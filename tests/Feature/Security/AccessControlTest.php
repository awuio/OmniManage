<?php

use App\Models\User;

test('unauthenticated users cannot access dashboard', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('unauthenticated users cannot manage products', function () {
    $response = $this->get(route('products.index'));
    $response->assertRedirect(route('login'));
});

test('authenticated user without permission cannot manage products', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get(route('products.index'));
    $response->assertStatus(403);
});
