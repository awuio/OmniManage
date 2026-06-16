<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ShopController extends Controller
{
    // Display all products in the shop (catalog page)
    public function index(\Illuminate\Http\Request $request)
    {
        $categories = Category::getCachedAll();

        // Best Practice:
        // 1. เติม with('category') เพื่อป้องกัน N+1 Query
        // 2. เปลี่ยน get() เป็น paginate() เพื่อให้รองรับข้อมูลจำนวนมากๆ ได้อย่างสวยงาม
        $products = Product::with('category')
            ->when($request->input('category_id'), function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $popularProducts = Cache::remember('shop_popular_products', 3600, function () {
            return Product::with('category')
                ->orderBy('views', 'desc')
                ->take(10)
                ->get();
        });

        return view('shop', compact('categories', 'products', 'popularProducts'));
    }

    // Display details for a single product
    public function show(Product $product)
    {
        $sessionKey = 'viewed_product_' . $product->id;
        if (!session()->has($sessionKey)) {
            $product->incrementViews();
            session()->put($sessionKey, true);
        }

        $product->load('category');

        // Fetch up to 10 related products from the same category, excluding the current product
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(10)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
