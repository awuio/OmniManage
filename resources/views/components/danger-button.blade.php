{{-- shadcn/ui-style destructive button --}}
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-9 px-4 py-2 bg-red-500 text-white shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 active:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-150']) }}>
    {{ $slot }}
</button>
