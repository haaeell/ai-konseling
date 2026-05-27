@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-2xl border-stone-200 bg-white px-4 py-3 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500']) }}>
