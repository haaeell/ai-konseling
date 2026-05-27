<x-app-layout>
    <x-slot name="title">Monitoring Sesi Konseling</x-slot>

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Admin</p>
            <h1 class="mt-1 text-3xl font-bold text-stone-950">Monitoring Sesi Konseling</h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-stone-500">
                Pantau percakapan, status sesi, dan tingkat risiko pengguna dari satu tempat yang mudah discan.
            </p>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white/80 px-5 py-4 text-right shadow-sm">
            <p class="text-xs text-stone-500">Total halaman ini</p>
            <p class="text-2xl font-bold text-teal-800">{{ $sessions->count() }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-stone-200 bg-[#fbfaf6] shadow-sm">
        <div class="grid gap-3 border-b border-stone-200 bg-white/70 px-5 py-4 text-xs font-semibold uppercase tracking-[0.14em] text-stone-500 lg:grid-cols-[1.3fr_1.5fr_.8fr_.8fr_.7fr_1fr_.6fr]">
            <div>User</div>
            <div>Judul</div>
            <div>Status</div>
            <div>Risk</div>
            <div>Pesan</div>
            <div>Tanggal</div>
            <div>Aksi</div>
        </div>

        <div class="divide-y divide-stone-200">
            @foreach($sessions as $session)
                <div class="grid gap-3 px-5 py-4 text-sm transition hover:bg-white/70 lg:grid-cols-[1.3fr_1.5fr_.8fr_.8fr_.7fr_1fr_.6fr] lg:items-center">
                    <div>
                        <div class="font-bold text-stone-900">{{ $session->user->name }}</div>
                        <div class="mt-1 truncate text-xs text-stone-500">{{ $session->user->email }}</div>
                    </div>

                    <div class="font-medium text-stone-800">{{ $session->title }}</div>

                    <div>
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold
                            {{ $session->status === 'emergency' ? 'bg-rose-100 text-rose-800' : ($session->status === 'closed' ? 'bg-stone-200 text-stone-700' : 'bg-teal-100 text-teal-800') }}">
                            {{ str_replace('_', ' ', $session->status) }}
                        </span>
                    </div>

                    <div>
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold
                            {{ $session->risk_level === 'high' ? 'bg-rose-100 text-rose-800' : ($session->risk_level === 'medium' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800') }}">
                            {{ $session->risk_level }}
                        </span>
                    </div>

                    <div class="font-bold text-stone-900">{{ $session->messages_count ?? $session->messages->count() }}</div>
                    <div class="text-stone-500">{{ $session->created_at->format('d M Y H:i') }}</div>

                    <div>
                        <a href="{{ route('admin.sessions.show', $session) }}"
                            class="inline-flex rounded-full border border-teal-200 bg-white px-3 py-2 text-xs font-bold text-teal-800 transition hover:bg-teal-50">
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="border-t border-stone-200 bg-white/70 p-5">
            {{ $sessions->links() }}
        </div>
    </div>
</x-app-layout>
