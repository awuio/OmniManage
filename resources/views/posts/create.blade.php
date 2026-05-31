<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-zinc-500">
            <a href="{{ route('posts.index') }}" class="hover:text-zinc-900 transition-colors">{{ __('messages.nav_blog') }}</a>
            <span>/</span>
            <span class="text-zinc-900 font-medium">{{ __('messages.title_add_post') }}</span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-zinc-200 rounded-lg">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-zinc-200">
                    <h3 class="text-sm font-semibold text-zinc-900">{{ __('messages.title_add_post') }}</h3>
                    <p class="text-xs text-zinc-500 mt-0.5">{{ __('messages.desc_add_post') }}</p>
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

                    <form method="POST" action="{{ route('posts.store') }}" class="space-y-5">
                        @csrf

                        <!-- Title -->
                        <div class="space-y-1.5">
                            <x-input-label for="title" :value="__('messages.label_title')" />
                            <x-text-input type="text" name="title" id="title" value="{{ old('title') }}"
                                placeholder="{{ __('messages.placeholder_title') }}" autofocus class="w-full" />
                            @error('title')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="space-y-1.5">
                            <x-input-label for="category_id" :value="__('messages.label_category')" />
                            <select name="category_id" id="category_id"
                                class="flex h-9 w-full rounded-md border border-zinc-300 bg-white px-3 py-1 text-sm text-zinc-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:border-zinc-400">
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>
                                    {{ __('messages.select_category') }}
                                </option>
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
                            @if ($categories->isEmpty())
                                <p class="text-xs text-amber-600">
                                    {{ __('messages.no_categories_warning') }}
                                    <a href="{{ route('categories.create') }}"
                                        class="font-semibold underline hover:text-amber-800">{{ __('messages.create_category_link') }}</a>
                                </p>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="space-y-1.5">
                            <x-input-label for="text" :value="__('messages.label_content')" />
                            <textarea name="text" id="text" rows="10"
                                placeholder="{{ __('messages.placeholder_content') }}"
                                class="flex w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:border-zinc-400">{{ old('text') }}</textarea>
                            @error('text')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-zinc-100">
                            <a href="{{ route('posts.index') }}"
                                class="inline-flex items-center justify-center h-9 px-4 rounded-md text-sm font-medium border border-zinc-200 bg-white text-zinc-900 hover:bg-zinc-50 transition-colors">
                                {{ __('messages.btn_cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('messages.btn_publish_post') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
