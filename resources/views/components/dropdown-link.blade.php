{{-- shadcn/ui-style dropdown menu item --}}
<a
    {{ $attributes->merge(['class' => 'block w-full px-3 py-1.5 text-start text-sm text-zinc-700 rounded-sm hover:bg-zinc-100 focus:outline-none focus:bg-zinc-100 transition duration-150 ease-in-out cursor-pointer']) }}>{{ $slot }}</a>
