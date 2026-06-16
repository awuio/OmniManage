<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('product detail page can be rendered', function () {
    $category = Category::create(['name' => 'Tech']);

    $product = Product::create([
        'name' => 'MacBook Pro',
        'description' => 'Apple Silicon computer',
        'price' => 59000,
        'quantity' => 10,
        'category_id' => $category->id,
        'views' => 0,
    ]);

    $response = $this->actingAs($this->user)
        ->get(route('shop.show', $product));

    $response->assertStatus(200);
    $response->assertSee('MacBook Pro');
    $response->assertSee('Apple Silicon computer');
    $response->assertSee('Tech');
    $response->assertSee('1 views'); // Views incremented from 0 to 1
});

test('product views count increments once per session to prevent spam', function () {
    $category = Category::create(['name' => 'Fashion']);

    $product = Product::create([
        'name' => 'Gucci Bag',
        'price' => 120000,
        'quantity' => 5,
        'category_id' => $category->id,
        'views' => 0, // Starts at 0 views
    ]);

    // 1st visit
    $this->actingAs($this->user)->get(route('shop.show', $product));
    expect($product->fresh()->views)->toBe(1);

    // 2nd visit in the same session - should not increment
    $this->actingAs($this->user)->get(route('shop.show', $product));
    expect($product->fresh()->views)->toBe(1);

    // Flush session to simulate a new session
    session()->flush();

    // 3rd visit (new session) - should increment
    $this->actingAs($this->user)->get(route('shop.show', $product));
    expect($product->fresh()->views)->toBe(2);
});

test('popular products sidebar renders correctly', function () {
    $category = Category::create(['name' => 'General']);

    $p1 = Product::create([
        'name' => 'Low View Product',
        'price' => 1000,
        'quantity' => 10,
        'category_id' => $category->id,
    ]);
    $p1->views = 5;
    $p1->save();

    $p2 = Product::create([
        'name' => 'High View Product',
        'price' => 2000,
        'quantity' => 5,
        'category_id' => $category->id,
    ]);
    $p2->views = 50;
    $p2->save();

    $response = $this->actingAs($this->user)->get(route('shop'));

    $response->assertStatus(200);
    $response->assertSeeInOrder([
        'Popular Products',
        'High View Product',
        '50 views',
        'Low View Product',
        '5 views',
    ]);
});
