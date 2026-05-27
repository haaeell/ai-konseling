<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center rounded-2xl border border-stone-200 bg-white px-5 py-3 text-sm font-bold text-stone-700 shadow-sm transition hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
