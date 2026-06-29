<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold text-zinc-900 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Statistics Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Filters and Search -->
                <div class="bg-white border border-zinc-200 rounded-lg p-4 flex flex-col justify-between">
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ __('messages.filters') }}</span>
                    <div class="mt-3">
                        <form method="GET" action="{{ route('products.index') }}" class="flex flex-col gap-2">
                            <select name="category_id" onchange="this.form.submit()"
                                class="flex h-9 w-full rounded-md border border-zinc-300 bg-white px-3 py-1 text-sm text-zinc-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:border-zinc-400">
                                <option value="">{{ __('messages.all_categories') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            
                            <div class="relative w-full">
                                <input type="text" name="search" value="{{ request('search') }}" 
                                    placeholder="{{ __('messages.search') }}" 
                                    class="flex h-9 w-full rounded-md border border-zinc-300 bg-white px-3 py-1 pr-8 text-sm text-zinc-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:border-zinc-400">
                                <button type="submit" class="absolute inset-y-0 right-0 px-2.5 flex items-center text-zinc-400 hover:text-zinc-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Total Products -->
                <div class="bg-white border border-zinc-200 rounded-lg p-4 flex flex-col justify-between">
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ __('messages.total_products') }}</span>
                    <span class="text-3xl font-bold text-zinc-900 mt-2">{{ number_format($totalProductsCount) }}</span>
                </div>

                <!-- Total Quantity -->
                <div class="bg-white border border-zinc-200 rounded-lg p-4 flex flex-col justify-between">
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ __('messages.total_quantity') }}</span>
                    <span class="text-3xl font-bold text-zinc-900 mt-2">{{ number_format($totalQuantitySum) }}</span>
                </div>

                <!-- Total Stock Value -->
                <div class="bg-white border border-zinc-200 rounded-lg p-4 flex flex-col justify-between">
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">{{ __('messages.total_stock_value') }}</span>
                    <span class="text-3xl font-bold text-zinc-900 mt-2">
                        {{ number_format($totalStockValueSum) }}
                    </span>
                </div>
            </div>

            <!-- Products List Card -->
            <div class="bg-white border border-zinc-200 rounded-lg" x-data="{ deleteProductId: null, deleteProductName: '' }">
                <!-- Card Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">{{ __('messages.title_manage_products') }}</h3>
                        <p class="text-xs text-zinc-500 mt-0.5">{{ __('messages.desc_manage_products') }}</p>
                    </div>
                    <x-primary-button href="{{ route('products.create') }}" class="h-8 px-3 text-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        {{ __('messages.btn_add_product') }}
                    </x-primary-button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead>
                            <tr class="bg-zinc-50">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_image') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_category') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_price') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_quantity') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_updated_at') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    {{ __('messages.table_actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-zinc-100">
                            @forelse ($products as $product)
                                <tr class="hover:bg-zinc-50 transition duration-100">
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-500">
                                        @if ($product->image)
                                            <img src="{{ $product->image_url }}"
                                                alt="Product Image"
                                                class="w-14 h-14 object-cover rounded-md border border-zinc-200">
                                        @else
                                            <div
                                                class="w-14 h-14 rounded-md bg-zinc-50 flex items-center justify-center text-xs font-semibold text-zinc-400 border border-dashed border-zinc-200">
                                                N/A
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-zinc-900">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-zinc-100 text-zinc-700">
                                            {{ $product->category?->name ?? __('messages.uncategorized') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-zinc-900">
                                        {{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-500">
                                        {{ number_format($product->quantity) }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-sm text-zinc-500">
                                        {{ $product->updated_at ? $product->updated_at->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="inline-flex items-center gap-1">
                                            <x-secondary-button href="{{ route('products.edit', $product) }}" class="h-7 px-2.5 text-xs">
                                                {{ __('messages.btn_edit') }}
                                            </x-secondary-button>
                                            <x-danger-button type="button" variant="link" class="h-7 px-2.5 text-xs"
                                                x-on:click.prevent="deleteProductId = {{ $product->id }}; deleteProductName = {{ Js::from($product->name) }}; $dispatch('open-modal', 'confirm-product-deletion')">
                                                {{ __('messages.btn_delete') }}
                                            </x-danger-button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-sm text-zinc-400">
                                        {{ __('messages.empty_products') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <x-modal name="confirm-product-deletion" focusable maxWidth="sm">
                    <form method="post" x-bind:action="'{{ route('products.destroy', 'PRODUCT_ID') }}'.replace('PRODUCT_ID', deleteProductId)" class="p-6">
                        @csrf
                        @method('DELETE')
                        <h2 class="text-lg font-medium text-zinc-900">
                            {{ __('messages.title_confirm_delete') }}
                        </h2>
                        <p class="mt-2 text-sm text-zinc-600">
                            {{ __('messages.desc_confirm_delete_product') }} <strong class="text-zinc-900" x-text="deleteProductName"></strong>?
                        </p>
                        <div class="mt-6 flex justify-end gap-3">
                            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                                {{ __('messages.btn_cancel') }}
                            </x-secondary-button>
                            <x-danger-button>
                                {{ __('messages.btn_delete_product') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>

                <!-- Pagination -->
                @if ($products->hasPages())
                    <div class="px-6 py-4 border-t border-zinc-200">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
