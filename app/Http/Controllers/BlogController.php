<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        // Load categories with count of their posts to display in the sidebar
        $categories = Cache::remember('blog_categories_with_count', 300, function () {
            return Category::withCount('posts')->get();
        });

        // Eager load category relation to prevent N+1 queries when rendering the category name badge
        $posts = Post::with('category')
            ->when($request->input('category_id'), function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('blog', compact('categories', 'posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Load categories with count of their posts to keep sidebar counters consistent
        $categories = Cache::remember('blog_categories_with_count', 300, function () {
            return Category::withCount('posts')->get();
        });

        $post->load('category');

        return view('blog.show', compact('categories', 'post'));
    }
}
