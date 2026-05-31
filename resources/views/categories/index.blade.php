<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold text-zinc-900 leading-tight">
            {{ __('messages.nav_categories') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-zinc-200 rounded-lg" x-data="{ deleteCategoryId: null, deleteCategoryName: '' }">
                <!-- Card Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">{{ __('messages.title_manage_categories') }}</h3>
                        <p class="text-xs text-zinc-500 mt-0.5">{{ __('messages.desc_manage_categories') }}</p>
                    </div>
                    <x-primary-button href="{{ route('categories.create') }}" class="h-8 px-3 text-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        {{ __('messages.btn_add_category') }}
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
                                    {{ __('messages.table_name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse($categories as $category)
                                <tr class="hover:bg-zinc-50 transition duration-100">
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-400">
                                        {{ $category->id }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-zinc-900">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="inline-flex items-center gap-1">
                                            <x-secondary-button href="{{ route('categories.edit', $category) }}"
                                                class="h-7 px-2.5 text-xs">
                                                {{ __('messages.btn_edit') }}
                                            </x-secondary-button>
                                            <x-danger-button type="button" variant="link" class="h-7 px-2.5 text-xs"
                                                x-on:click.prevent="deleteCategoryId = {{ $category->id }}; deleteCategoryName = {{ Js::from($category->name) }}; $dispatch('open-modal', 'confirm-category-deletion')">
                                                {{ __('messages.btn_delete') }}
                                            </x-danger-button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-sm text-zinc-400">
                                        {{ __('messages.empty_categories') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($categories->hasPages())
                    <div class="px-6 py-4 border-t border-zinc-200">
                        {{ $categories->links() }}
                    </div>
                @endif
                
                <x-modal name="confirm-category-deletion" focusable maxWidth="sm">
                    <form method="post"
                        x-bind:action="'{{ route('categories.destroy', 'CATEGORY_ID') }}'.replace('CATEGORY_ID', deleteCategoryId)"
                        class="p-6">
                        @csrf
                        @method('DELETE')
                        <h2 class="text-lg font-medium text-zinc-900">
                            {{ __('messages.title_confirm_delete') }}
                        </h2>
                        <p class="mt-2 text-sm text-zinc-600">
                            {{ __('messages.desc_confirm_delete_category') }} <strong class="text-zinc-900"
                                x-text="deleteCategoryName"></strong>?
                        </p>
                        <div class="mt-6 flex justify-end gap-3">
                            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                                {{ __('messages.btn_cancel') }}
                            </x-secondary-button>
                            <x-danger-button>
                                {{ __('messages.btn_delete_category') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
    </div>
</x-app-layout>

