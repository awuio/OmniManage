<?php

use App\Models\User;
use App\Models\Post;

beforeEach(function () {
    $this->admin = User::factory()->create();
    $this->admin->assignRole(\Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super-admin']));
});

test('sql injection is prevented on shop search', function () {
    // Injecting a raw SQL payload
    $maliciousInput = "1' OR '1'='1";
    $response = $this->get(route('shop', ['search' => $maliciousInput]));
    
    // As long as the framework processes it safely without throwing 500 (SQL exception)
    $response->assertStatus(200);
});

test('xss injection is escaped in blog post display', function () {
    $maliciousHtml = "<script>alert('xss')</script>";
    
    // Create a post with malicious payload
    $post = Post::factory()->create([
        'title' => 'Normal Title',
        'text' => $maliciousHtml
    ]);

    // View the post
    $response = $this->get(route('blog.show', $post));
    
    $response->assertStatus(200);
    
    // Blade should escape it automatically
    // Therefore, the raw script tag should NOT exist in the source code
    $response->assertDontSee($maliciousHtml, false);
});
