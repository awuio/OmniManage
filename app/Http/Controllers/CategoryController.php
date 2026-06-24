<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CategoryServiceInterface;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryServiceInterface $categoryService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $this->categoryService->createCategory($request->validated());

            return redirect()->route('categories.index')->with('success', __('messages.category_created'));
        } catch (\Exception $e) {
            Log::error('Category Creation Failed: ' . $e->getMessage(), [
                'request_data' => $request->validated()
            ]);
            return redirect()->back()->withInput()->with('error', __('messages.category_error') ?? 'Error creating category.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $this->categoryService->updateCategory($category, $request->validated());

            return redirect()->route('categories.index')->with('success', __('messages.category_updated'));
        } catch (\Exception $e) {
            Log::error('Category Update Failed: ' . $e->getMessage(), [
                'category_id' => $category->id,
                'request_data' => $request->validated()
            ]);
            return redirect()->back()->withInput()->with('error', __('messages.category_error') ?? 'Error updating category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Check if there are any products or posts associated with this category
            if ($category->products()->withTrashed()->exists() || $category->posts()->withTrashed()->exists()) {
                return redirect()->back()->with('error', __('messages.category_delete_error'));
            }

            $category->delete();

            return redirect()->route('categories.index')->with('success', __('messages.category_deleted'));
        } catch (\Exception $e) {
            Log::error('Category Deletion Failed: ' . $e->getMessage(), [
                'category_id' => $category->id
            ]);
            return redirect()->back()->with('error', __('messages.category_error') ?? 'Error deleting category.');
        }
    }
}
