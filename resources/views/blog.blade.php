<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-900 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-zinc-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Blog Posts Section -->
                <main class="lg:col-span-3 space-y-6">
                    <div class="bg-white border border-zinc-200 rounded-xl p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-zinc-900 mb-6 tracking-tight">Latest Posts</h2>
                        
                        <div class="divide-y divide-zinc-100 space-y-6">
                            @forelse ($posts as $post)
                                <article class="pt-6 first:pt-0 pb-6 last:pb-0">
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2 text-xs text-zinc-500">
                                            <span>Posted {{ $post->created_at->diffForHumans() }}</span>
                                            @if($post->category)
                                                <span>•</span>
                                                <span class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-800 ring-1 ring-inset ring-zinc-600/10">
                                                    {{ $post->category->name }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <h3 class="text-lg font-semibold text-zinc-900 hover:text-zinc-600 transition-colors">
                                            <a href="{{ route('blog.show', $post) }}" class="hover:underline tracking-tight">{{ $post->title }}</a>
                                        </h3>
                                        
                                        <p class="text-sm leading-relaxed text-zinc-600 mt-2">{{ Str::limit($post->text, 250) }}</p>
                                        
                                        <div class="pt-3">
                                            <a href="{{ route('blog.show', $post) }}" class="inline-flex items-center text-xs font-semibold text-zinc-900 hover:text-zinc-700">
                                                Read more
                                                <svg class="ml-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @empty
                                <div class="py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-zinc-900">No posts found</h3>
                                    <p class="mt-1 text-sm text-zinc-500">There are no posts available in this category at the moment.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Pagination Links -->
                        @if($posts->hasPages())
                            <div class="mt-8 pt-6 border-t border-zinc-100">
                                {{ $posts->links() }}
                            </div>
                        @endif
                    </div>
                </main>
                
                <!-- Sidebar Section -->
                <aside class="space-y-6">
                    <div class="bg-white border border-zinc-200 rounded-xl p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-4 pb-2 border-b border-zinc-100">
                            <h2 class="text-sm font-bold text-zinc-900 uppercase tracking-wider">Categories</h2>
                            @if(request('category_id'))
                                <a href="{{ route('blog') }}" class="text-xs text-zinc-500 hover:text-zinc-900 hover:underline flex items-center gap-1">
                                    Clear Filter
                                </a>
                            @endif
                        </div>
                        
                        <nav class="space-y-1">
                            <a href="{{ route('blog') }}" 
                               class="group flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md transition-all {{ !request('category_id') ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                                <span>All Categories</span>
                            </a>
                            
                            @foreach ($categories as $category)
                                <a href="{{ route('blog', ['category_id' => $category->id]) }}"
                                   class="group flex items-center justify-between px-3 py-2 text-sm font-medium rounded-md transition-all {{ request('category_id') == $category->id ? 'bg-zinc-900 text-white' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                                    <span class="truncate">{{ $category->name }}</span>
                                    @if($category->posts_count !== null)
                                        <span class="ml-3 inline-block py-0.5 px-2 text-xs font-semibold rounded-full {{ request('category_id') == $category->id ? 'bg-zinc-800 text-zinc-200' : 'bg-zinc-100 text-zinc-600' }}">
                                            {{ $category->posts_count }}
                                        </span>
                                    @endif
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </aside>
                
            </div>
        </div>
    </div>
</x-app-layout>

