@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-2xl bg-teal-700 px-4 py-3 text-start text-base font-bold text-white transition'
            : 'block w-full rounded-2xl px-4 py-3 text-start text-base font-medium text-stone-600 transition hover:bg-white hover:text-teal-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
