<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        // Build the base query with eager-loaded category to avoid N+1
        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Clone the builder before running aggregates so each call
        // gets a clean query without carrying over previous state.
        // withoutEagerLoads() prevents the cloned with('category') from firing
        // an unnecessary relationship query on a pure-aggregate result.
        $stats = (clone $query)->withoutEagerLoads()->selectRaw('count(*) as total_count, sum(quantity) as total_qty, sum(price * quantity) as total_value')->first();

        $totalProductsCount = $stats->total_count;
        $totalQuantitySum = $stats->total_qty;
        $totalStockValueSum = $stats->total_value;

        // Paginate and preserve the query string (e.g. category_id) in pagination links
        $products = $query->paginate(10)->withQueryString();

        return view('products.index', compact(
            'products',
            'categories',
            'totalProductsCount',
            'totalQuantitySum',
            'totalStockValueSum'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $uploadedImage = null;

        try {
            if ($request->hasFile('image')) {
                // Store the uploaded image first
                $uploadedImage = $request->file('image')->store('products', 'public');
                $data['image'] = $uploadedImage;
            }

            Product::create($data);

            return redirect()->route('products.index')->with('success', 'สร้างสินค้าใหม่สำเร็จเรียบร้อยแล้ว');
        } catch (\Exception $e) {
            // Clean up the uploaded image from disk storage if database record creation fails
            if ($uploadedImage) {
                Storage::disk('public')->delete($uploadedImage);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูลสินค้า: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return redirect()->route('shop.show', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $oldImage = $product->image;
        $newImageUploaded = null;

        try {
            if ($request->hasFile('image')) {
                // Upload new image first, but do not delete old one yet (database integrity)
                $newImageUploaded = $request->file('image')->store('products', 'public');
                $validated['image'] = $newImageUploaded;
            } else {
                // Prevent over-writing old image with null when no new image is uploaded
                unset($validated['image']);
            }

            // Update database record
            $product->update($validated);

            // If database update succeeds, delete old image to free disk space
            if ($newImageUploaded && $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            return redirect()->route('products.index')->with('success', 'อัปเดตข้อมูลสินค้าสำเร็จ');
        } catch (\Exception $e) {
            // Clean up the new uploaded image from disk storage if database update fails
            if ($newImageUploaded) {
                Storage::disk('public')->delete($newImageUploaded);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูลสินค้า: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'ลบสินค้าสำเร็จเรียบร้อยแล้ว');
    }
}
