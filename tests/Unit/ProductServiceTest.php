<?php

use App\DataTransferObjects\ProductData;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->productService = new ProductService();
    Storage::fake('public');
});

test('it creates a product and stores image successfully', function () {
    $category = Category::factory()->create();
    $image = UploadedFile::fake()->create('test_product.jpg', 100);
    
    $productData = new ProductData(
        name: 'Test Product',
        description: 'Description',
        price: 100.50,
        quantity: 50,
        category_id: $category->id,
    );

    $product = $this->productService->createProduct($productData, $image);

    expect($product)->toBeInstanceOf(Product::class)
        ->and($product->name)->toBe('Test Product')
        ->and($product->image)->not->toBeNull();

    Storage::disk('public')->assertExists($product->getRawOriginal('image'));
});

test('it rolls back and deletes uploaded image if product creation fails in db', function () {
    $image = UploadedFile::fake()->create('test_product_fail.jpg', 100);
    
    // Invalid category_id will cause DB exception
    $productData = new ProductData(
        name: 'Test Product Fail',
        description: 'Description',
        price: 100.50,
        quantity: 50,
        category_id: 99999, // Does not exist
    );

    try {
        $this->productService->createProduct($productData, $image);
    } catch (\Exception $e) {
        // Expected
    }

    // Verify image was cleaned up
    $files = Storage::disk('public')->allFiles('products');
    expect($files)->toBeEmpty();
});

test('it updates a product and replaces image successfully', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'image' => 'products/old_image.jpg',
        'category_id' => $category->id
    ]);

    Storage::disk('public')->put('products/old_image.jpg', 'fake content');

    $newImage = UploadedFile::fake()->create('new_product.jpg', 100);
    
    $productData = new ProductData(
        name: 'Updated Product',
        description: 'New Description',
        price: 200.00,
        quantity: 10,
        category_id: $category->id,
    );

    $updatedProduct = $this->productService->updateProduct($product, $productData, $newImage);

    expect($updatedProduct->name)->toBe('Updated Product')
        ->and($updatedProduct->getRawOriginal('image'))->not->toBe('products/old_image.jpg');

    Storage::disk('public')->assertExists($updatedProduct->getRawOriginal('image'));
    Storage::disk('public')->assertMissing('products/old_image.jpg');
});

test('it rolls back and deletes new uploaded image if product update fails in db', function () {
    $category = Category::factory()->create();
    $product = Product::factory()->create([
        'image' => 'products/existing_image.jpg',
        'category_id' => $category->id
    ]);

    Storage::disk('public')->put('products/existing_image.jpg', 'fake content');

    $newImage = UploadedFile::fake()->create('failing_update_image.jpg', 100);
    
    // Invalid category_id will cause DB exception
    $productData = new ProductData(
        name: 'Updated Product Fail',
        description: 'New Description',
        price: 200.00,
        quantity: 10,
        category_id: 99999, // Does not exist
    );

    try {
        $this->productService->updateProduct($product, $productData, $newImage);
    } catch (\Exception $e) {
        // Expected
    }

    // Verify new image was cleaned up, but old image remains
    Storage::disk('public')->assertExists('products/existing_image.jpg');
    
    // The new image shouldn't exist. There should only be 1 file in 'products' directory
    $files = Storage::disk('public')->allFiles('products');
    expect(count($files))->toBe(1);
});
