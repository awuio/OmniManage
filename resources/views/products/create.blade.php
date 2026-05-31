<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-zinc-500">
            <a href="{{ route('products.index') }}" class="hover:text-zinc-900 transition-colors">{{ __('messages.nav_products') }}</a>
            <span>/</span>
            <span class="text-zinc-900 font-medium">{{ __('messages.title_add_product') }}</span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-zinc-200 rounded-lg">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-zinc-200">
                    <h3 class="text-sm font-semibold text-zinc-900">{{ __('messages.title_add_product') }}</h3>
                    <p class="text-xs text-zinc-500 mt-0.5">{{ __('messages.desc_add_product') }}</p>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-6 flex gap-3 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                            <svg class="h-4 w-4 mt-0.5 shrink-0 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <ul class="space-y-1 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf

                        <!-- Name -->
                        <div class="space-y-1.5">
                            <x-input-label for="name" :value="__('messages.label_product_name')" />
                            <x-text-input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="{{ __('messages.placeholder_product_name') }}" class="w-full" required />
                            @error('name')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="space-y-1.5">
                            <x-input-label for="category_id" :value="__('messages.label_category')" />
                            <select name="category_id" id="category_id" required
                                class="flex h-9 w-full rounded-md border border-zinc-300 bg-white px-3 py-1 text-sm text-zinc-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:border-zinc-400">
                                <option value="" disabled selected>{{ __('messages.select_category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price & Quantity -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <x-input-label for="price" :value="__('messages.label_price')" />
                                <x-text-input type="number" step="0.01" min="0" name="price" id="price"
                                    value="{{ old('price') }}" placeholder="{{ __('messages.placeholder_price') }}" class="w-full" required />
                                @error('price')
                                    <p class="text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-1.5">
                                <x-input-label for="quantity" :value="__('messages.label_quantity')" />
                                <x-text-input type="number" min="0" name="quantity" id="quantity"
                                    value="{{ old('quantity') }}" placeholder="{{ __('messages.placeholder_quantity') }}" class="w-full" required />
                                @error('quantity')
                                    <p class="text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="space-y-1.5">
                            <x-input-label for="image" :value="__('messages.label_product_image')" />
                            <input type="file" name="image" id="image" accept="image/*"
                                class="flex w-full rounded-md border border-zinc-300 bg-white text-sm text-zinc-500 shadow-sm file:mr-4 file:py-1.5 file:px-3 file:rounded-l-md file:border-0 file:border-r file:border-zinc-300 file:text-xs file:font-medium file:bg-zinc-50 file:text-zinc-700 hover:file:bg-zinc-100 focus:outline-none focus:ring-2 focus:ring-zinc-400">
                            @error('image')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="space-y-1.5">
                            <x-input-label for="description" :value="__('messages.label_description')" />
                            <textarea name="description" id="description" rows="4"
                                placeholder="{{ __('messages.placeholder_description') }}"
                                class="flex w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:border-zinc-400">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-zinc-100">
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center justify-center h-9 px-4 rounded-md text-sm font-medium border border-zinc-200 bg-white text-zinc-900 hover:bg-zinc-50 transition-colors">
                                {{ __('messages.btn_cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('messages.btn_save_product') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
