<?php

use App\Models\Post;
use App\Models\User;


beforeEach(function () {
    $this->admin = User::factory()->create();
    $this->admin->assignRole(\Spatie\Permission\Models\Role::firstOrCreate(['name' => 'super-admin']));
    $this->user = User::factory()->create();
});

test('admin can view posts index', function () {
    Post::factory()->count(3)->create();

    $response = $this->actingAs($this->admin)->get(route('posts.index'));

    $response->assertStatus(200);
    $response->assertViewHas('posts');
});

test('non-admin cannot view posts index', function () {
    $response = $this->actingAs($this->user)->get(route('posts.index'));

    $response->assertStatus(403);
});

test('admin can create a new post', function () {
    $category = \App\Models\Category::factory()->create();

    $response = $this->actingAs($this->admin)->post(route('posts.store'), [
        'title' => 'My First Post',
        'text' => 'This is the content of my first post.',
        'category_id' => $category->id,
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'title' => 'My First Post',
    ]);
});

test('admin can update a post', function () {
    $post = Post::factory()->create(['title' => 'Old Title']);

    $response = $this->actingAs($this->admin)->put(route('posts.update', $post), [
        'title' => 'New Awesome Title',
        'text' => $post->text,
        'category_id' => $post->category_id,
    ]);

    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'New Awesome Title',
    ]);
});

test('admin can soft delete a post', function () {
    $post = Post::factory()->create();

    $response = $this->actingAs($this->admin)->delete(route('posts.destroy', $post));

    $response->assertRedirect(route('posts.index'));
    $this->assertSoftDeleted($post);
});

test('post creation fails with missing fields', function () {
    $response = $this->actingAs($this->admin)->post(route('posts.store'), []);

    $response->assertSessionHasErrors(['title', 'text', 'category_id']);
});

test('post creation fails with invalid category_id', function () {
    $response = $this->actingAs($this->admin)->post(route('posts.store'), [
        'title' => 'Title',
        'text' => 'Content',
        'category_id' => 99999, // Non-existent ID
    ]);

    $response->assertSessionHasErrors(['category_id']);
});

test('non-admin cannot create a post', function () {
    $category = \App\Models\Category::factory()->create();

    $response = $this->actingAs($this->user)->post(route('posts.store'), [
        'title' => 'Unauthorized Post',
        'text' => 'Some content.',
        'category_id' => $category->id,
    ]);

    $response->assertStatus(403);
});

test('non-admin cannot update a post', function () {
    $post = Post::factory()->create(['title' => 'Old Title']);

    $response = $this->actingAs($this->user)->put(route('posts.update', $post), [
        'title' => 'New Title Attempt',
        'text' => $post->text,
        'category_id' => $post->category_id,
    ]);

    $response->assertStatus(403);
});

test('non-admin cannot delete a post', function () {
    $post = Post::factory()->create();

    $response = $this->actingAs($this->user)->delete(route('posts.destroy', $post));

    $response->assertStatus(403);
});

test('post update fails with invalid category_id', function () {
    $post = Post::factory()->create();

    $response = $this->actingAs($this->admin)->put(route('posts.update', $post), [
        'title' => 'Updated Title',
        'text' => 'Some updated text',
        'category_id' => 99999, // Non-existent ID
    ]);

    $response->assertSessionHasErrors(['category_id']);
});
