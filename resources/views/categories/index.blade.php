<x-app-layout>
    <x-slot name="header">
        <h2 class="text-base font-semibold text-zinc-900 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-zinc-200 rounded-lg">
                <!-- Card Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900">Manage Categories</h3>
                        <p class="text-xs text-zinc-500 mt-0.5">Add, update, or remove categories from your system.</p>
                    </div>
                    <a href="{{ route('categories.create') }}"
                        class="inline-flex items-center gap-1.5 h-8 px-3 rounded-md text-xs font-medium bg-zinc-900 text-white hover:bg-zinc-700 transition-colors duration-150">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                        </svg>
                        Add category
                    </a>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200">
                        <thead>
                            <tr class="bg-zinc-50">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-zinc-500 uppercase tracking-wider">
                                    Actions
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
                                            <a href="{{ route('categories.edit', $category) }}"
                                                class="inline-flex items-center h-7 px-2.5 rounded-md text-xs font-medium border border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 transition-colors">
                                                Edit
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}"
                                                method="post" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                    class="inline-flex items-center h-7 px-2.5 rounded-md text-xs font-medium text-red-600 hover:bg-red-50 hover:text-red-700 border border-transparent hover:border-red-200 transition-colors">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-sm text-zinc-400">
                                        No categories found. Click "Add category" to get started!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
