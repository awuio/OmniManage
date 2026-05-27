@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-3 py-1.5 rounded-md text-sm font-semibold text-zinc-900 bg-zinc-100 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium text-zinc-500 hover:text-zinc-900 hover:bg-zinc-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
