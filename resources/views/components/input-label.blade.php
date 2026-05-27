@props(['value'])

{{-- shadcn/ui-style label --}}
<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-zinc-700 leading-none']) }}>
    {{ $value ?? $slot }}
</label>
