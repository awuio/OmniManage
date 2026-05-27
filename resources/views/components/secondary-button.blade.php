{{-- shadcn/ui-style secondary (outline) button --}}
<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium h-9 px-4 py-2 border border-zinc-200 bg-white text-zinc-900 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-150']) }}>
    {{ $slot }}
</button>
