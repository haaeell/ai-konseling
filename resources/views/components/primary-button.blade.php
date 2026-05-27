<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-2xl border border-transparent bg-teal-700 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
