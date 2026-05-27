<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-zinc-500">
            <a href="{{ route('categories.index') }}" class="hover:text-zinc-900 transition-colors">Categories</a>
            <span>/</span>
            <span class="text-zinc-900 font-medium">Edit Category</span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-zinc-200 rounded-lg">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-zinc-200">
                    <h3 class="text-sm font-semibold text-zinc-900">Edit Category</h3>
                    <p class="text-xs text-zinc-500 mt-0.5">Update the name of the category. This will update the
                        category name across all associated posts and products.</p>
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

                    <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <!-- Category Name -->
                        <div class="space-y-1.5">
                            <x-input-label for="name" value="Category Name" />
                            <x-text-input type="text" name="name" id="name"
                                value="{{ old('name', $category->name) }}" class="w-full" required />
                            @error('name')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-2 pt-2 border-t border-zinc-100">
                            <a href="{{ route('categories.index') }}"
                                class="inline-flex items-center justify-center h-9 px-4 rounded-md text-sm font-medium border border-zinc-200 bg-white text-zinc-900 hover:bg-zinc-50 transition-colors">
                                Cancel
                            </a>
                            <x-primary-button>
                                Save Changes
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
