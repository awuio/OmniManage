<?php

use App\Models\User;


beforeEach(function () {
    $this->admin = User::factory()->create();
    $this->admin->assignRole(\Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super-admin']));
    $this->user = User::factory()->create();
});

test('admin can view dashboard', function () {
    $response = $this->actingAs($this->admin)->get(route('dashboard'));

    $response->assertStatus(200);
});

test('non-admin cannot view dashboard', function () {
    $response = $this->actingAs($this->user)->get(route('dashboard'));

    $response->assertStatus(403);
});

test('guest cannot view dashboard', function () {
    $response = $this->get(route('dashboard'));

    $response->assertRedirect(route('login'));
});
