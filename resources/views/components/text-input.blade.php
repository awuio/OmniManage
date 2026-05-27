@props(['disabled' => false])

{{-- shadcn/ui-style text input --}}
<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'flex h-9 w-full rounded-md border border-zinc-300 bg-white px-3 py-1 text-sm text-zinc-900 placeholder:text-zinc-400 shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:border-zinc-400 disabled:cursor-not-allowed disabled:opacity-50']) }}>
