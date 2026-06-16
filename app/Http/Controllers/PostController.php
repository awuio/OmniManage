<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::getCachedAll();

        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        try {
            Post::create($request->validated());

            return redirect()->route('posts.index')->with('success', __('messages.post_created'));
        } catch (\Exception $e) {
            Log::error('Post Creation Failed: ' . $e->getMessage(), [
                'request_data' => $request->validated()
            ]);
            return redirect()->back()->withInput()->with('error', __('messages.post_error') ?? 'Error creating post.');
        }
    }

    public function show(Post $post)
    {
        // Redirect back-end 'show' request to the public single blog post view
        return redirect()->route('blog.show', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::getCachedAll();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            // When execution reaches this point, it means the data has passed validation from UpdatePostRequest 100%
            // Use $request->validated() to retrieve only the data defined in the rules() for updating
            $post->update($request->validated());

            return redirect()->route('posts.index')->with('success', __('messages.post_updated'));
        } catch (\Exception $e) {
            Log::error('Post Update Failed: ' . $e->getMessage(), [
                'post_id' => $post->id,
                'request_data' => $request->validated()
            ]);
            return redirect()->back()->withInput()->with('error', __('messages.post_error') ?? 'Error updating post.');
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', __('messages.post_deleted'));
    }
}
