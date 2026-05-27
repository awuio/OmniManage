@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-4 pe-4 py-2.5 border-l-2 border-zinc-900 text-start text-sm font-semibold text-zinc-900 bg-zinc-50 focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full ps-4 pe-4 py-2.5 border-l-2 border-transparent text-start text-sm font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 hover:border-zinc-300 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
