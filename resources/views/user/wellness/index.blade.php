<x-app-layout>
    <x-slot name="title">Ruang Tenang</x-slot>

    <div class="space-y-5">
        <section class="overflow-hidden rounded-[32px] border border-stone-200 bg-[#fbfaf6] shadow-sm">
            <div class="bg-teal-800 px-5 py-7 text-white sm:px-8">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-100">Ruang Tenang</p>
                <h1 class="mt-2 max-w-2xl text-3xl font-bold leading-tight sm:text-4xl">Ambil jeda sebentar sebelum melanjutkan hari.</h1>
                <p class="mt-3 max-w-2xl text-sm leading-relaxed text-teal-50">
                    Pilih latihan singkat yang terasa paling mungkin dilakukan sekarang. Tidak perlu sempurna, yang penting mulai pelan.
                </p>
            </div>
        </section>

        <div class="grid gap-4 md:grid-cols-3">
            <section class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">1 Menit</p>
                <h2 class="mt-2 text-xl font-bold text-stone-950">Napas 4-4-6</h2>
                <p class="mt-2 text-sm leading-relaxed text-stone-500">Tarik napas 4 hitungan, tahan 4 hitungan, buang 6 hitungan. Ulangi 4 kali.</p>
            </section>

            <section class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Grounding</p>
                <h2 class="mt-2 text-xl font-bold text-stone-950">5-4-3-2-1</h2>
                <p class="mt-2 text-sm leading-relaxed text-stone-500">Sebut 5 hal yang terlihat, 4 yang terasa, 3 yang terdengar, 2 aroma, dan 1 rasa.</p>
            </section>

            <section class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Refleksi</p>
                <h2 class="mt-2 text-xl font-bold text-stone-950">Pertanyaan Ringan</h2>
                <p class="mt-2 text-sm leading-relaxed text-stone-500">Apa satu hal kecil yang bisa membuat 10 menit ke depan terasa sedikit lebih mudah?</p>
            </section>
        </div>

        <section class="grid gap-5 lg:grid-cols-[1fr_360px]">
            <div class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Cek Kondisi</p>
                <h2 class="mt-1 text-2xl font-bold text-stone-950">Bagaimana energimu sekarang?</h2>

                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    @foreach(['Tenang', 'Lelah', 'Cemas', 'Sedih'] as $mood)
                        <a href="{{ route('chat.index') }}"
                            class="rounded-3xl border border-stone-200 bg-white p-4 text-left shadow-sm transition hover:border-teal-200 hover:bg-teal-50">
                            <div class="font-bold text-stone-950">{{ $mood }}</div>
                            <div class="mt-1 text-sm text-stone-500">Lanjutkan cerita lewat chat AI.</div>
                        </a>
                    @endforeach
                </div>
            </div>

            <aside class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Sesi Terakhir</p>
                <h2 class="mt-1 text-xl font-bold text-stone-950">Lanjutkan Percakapan</h2>

                <div class="mt-4 space-y-3">
                    @forelse($recentSessions as $session)
                        <a href="{{ route('chat.show', $session) }}" class="block rounded-3xl border border-stone-200 bg-white p-4 transition hover:bg-teal-50">
                            <div class="truncate font-bold text-stone-900">{{ $session->title }}</div>
                            <div class="mt-1 text-xs text-stone-500">{{ $session->created_at->format('d M Y H:i') }}</div>
                        </a>
                    @empty
                        <p class="rounded-3xl border border-stone-200 bg-white p-4 text-sm text-stone-500">
                            Belum ada sesi. Kamu bisa mulai dari chat baru kapan saja.
                        </p>
                    @endforelse
                </div>
            </aside>
        </section>
    </div>
</x-app-layout>
