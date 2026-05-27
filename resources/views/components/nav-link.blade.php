@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center rounded-full bg-teal-700 px-3 py-2 text-sm font-bold text-white transition'
            : 'inline-flex items-center rounded-full px-3 py-2 text-sm font-medium text-stone-600 transition hover:bg-white hover:text-teal-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
