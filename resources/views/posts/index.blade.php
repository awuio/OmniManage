<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold text-zinc-900 leading-tight">
            {{ __('messages.nav_blog') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-zinc-200 rounded-lg" x-data="{ deletePostId: null, deletePostTitle: '' }">
                <!-- Card Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">{{ __('messages.title_manage_posts') }}</h3>
                        <p class="text-xs text-zinc-500 mt-0.5">{{ __('messages.desc_manage_posts') }}</p>
                    </div>
                    <x-primary-button href="{{ route('posts.create') }}" class="h-8 px-3 text-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        {{ __('messages.btn_add_post') }}
                    </x-primary-button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead>
                            <tr class="bg-zinc-50">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_id') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_title') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_category') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_created_date') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse($posts as $post)
                                <tr class="hover:bg-zinc-50 transition duration-100">
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-400">
                                        {{ $post->id }}
                                    </td>
                                    <td class="px-6 py-3 text-sm font-medium text-zinc-900 max-w-xs truncate">
                                        {{ $post->title }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-zinc-100 text-zinc-700">
                                            {{ $post->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-500">
                                        {{ $post->created_at ? $post->created_at->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="inline-flex items-center gap-1">
                                            <x-secondary-button href="{{ route('posts.edit', $post) }}" class="h-7 px-2.5 text-xs">
                                                {{ __('messages.btn_edit') }}
                                            </x-secondary-button>
                                            <x-danger-button type="button" variant="link" class="h-7 px-2.5 text-xs"
                                                x-on:click.prevent="deletePostId = {{ $post->id }}; deletePostTitle = {{ Js::from($post->title) }}; $dispatch('open-modal', 'confirm-post-deletion')">
                                                {{ __('messages.btn_delete') }}
                                            </x-danger-button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-zinc-400">
                                        {{ __('messages.empty_posts') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <x-modal name="confirm-post-deletion" focusable maxWidth="sm">
                    <form method="post" x-bind:action="'{{ route('posts.destroy', 'POST_ID') }}'.replace('POST_ID', deletePostId)" class="p-6">
                        @csrf
                        @method('DELETE')
                        <h2 class="text-lg font-medium text-zinc-900">
                            {{ __('messages.title_confirm_delete') }}
                        </h2>
                        <p class="mt-2 text-sm text-zinc-600">
                            {{ __('messages.desc_confirm_delete_post') }} <strong class="text-zinc-900" x-text="deletePostTitle"></strong>?
                        </p>
                        <div class="mt-6 flex justify-end gap-3">
                            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                                {{ __('messages.btn_cancel') }}
                            </x-secondary-button>
                            <x-danger-button>
                                {{ __('messages.btn_delete_post') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>

                <!-- Pagination -->
                @if ($posts->hasPages())
                    <div class="px-6 py-4 border-t border-zinc-200">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
