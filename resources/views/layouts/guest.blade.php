<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AI Konseling') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f6f3ec] text-stone-900 antialiased">
        <div class="flex min-h-screen items-center justify-center bg-[radial-gradient(circle_at_top_left,#fdf6e8_0%,transparent_30%),radial-gradient(circle_at_top_right,#dff3ea_0%,transparent_28%),linear-gradient(135deg,#f6f3ec_0%,#eef5ee_48%,#f7f0e4_100%)] px-4 py-6 sm:py-10">
            <div class="grid w-full max-w-6xl overflow-hidden rounded-[32px] border border-stone-200 bg-[#fbfaf6] shadow-xl shadow-stone-900/10 lg:grid-cols-[1fr_440px]">
                <section class="hidden min-h-[620px] flex-col justify-between bg-[linear-gradient(165deg,#134e4a,#115e59_45%,#0f172a)] p-10 text-white lg:flex">
                    <div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 text-sm font-bold">
                            AI
                        </div>
                        <h1 class="mt-8 text-4xl font-bold leading-tight">AI Konseling</h1>
                        <p class="mt-4 max-w-sm text-sm leading-relaxed text-teal-50">
                            Ruang dukungan awal yang membantu pengguna mulai bercerita dengan lebih tenang, lebih terarah, dan lebih siap melanjutkan sesi.
                        </p>

                        <div class="mt-8 grid gap-3">
                            <div class="rounded-3xl border border-white/10 bg-white/10 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-100">Aman Untuk Memulai</p>
                                <p class="mt-2 text-sm leading-relaxed text-teal-50">Tidak harus sempurna. Satu kalimat pendek pun cukup untuk membuka percakapan.</p>
                            </div>
                            <div class="rounded-3xl border border-white/10 bg-white/10 p-4">
                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-100">Riwayat Tersimpan</p>
                                <p class="mt-2 text-sm leading-relaxed text-teal-50">Pengguna bisa kembali ke sesi sebelumnya tanpa kehilangan konteks.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="rounded-3xl border border-white/15 bg-white/10 p-5">
                            <p class="text-sm leading-relaxed text-teal-50">
                                "Mulai dari satu kalimat. Kadang yang paling membantu adalah punya ruang untuk mengurai."
                            </p>
                        </div>
                        <a href="{{ route('landing') }}" class="inline-flex items-center text-sm font-bold text-teal-100 transition hover:text-white">
                            Kembali ke landing page
                        </a>
                    </div>
                </section>

                <main class="px-5 py-6 sm:px-8 sm:py-8 lg:px-10">
                    <div class="mb-8 lg:hidden">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-700 text-sm font-bold text-white">
                                    AI
                                </div>
                                <h1 class="mt-4 text-2xl font-bold">AI Konseling</h1>
                            </div>
                            <a href="{{ route('landing') }}" class="rounded-full border border-stone-200 bg-white px-4 py-2 text-sm font-bold text-stone-700 shadow-sm">
                                Landing
                            </a>
                        </div>
                        <p class="mt-3 max-w-md text-sm leading-relaxed text-stone-500">
                            Masuk atau daftar untuk mulai menggunakan ruang dukungan awal dengan tampilan yang sederhana dan nyaman di mobile.
                        </p>
                    </div>

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
