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
        <div class="flex min-h-screen items-center justify-center bg-[linear-gradient(135deg,#f6f3ec_0%,#eef5ee_48%,#f7f0e4_100%)] px-4 py-10">
            <div class="grid w-full max-w-5xl overflow-hidden rounded-[32px] border border-stone-200 bg-[#fbfaf6] shadow-sm lg:grid-cols-[1fr_420px]">
                <section class="hidden min-h-[560px] flex-col justify-between bg-teal-800 p-10 text-white lg:flex">
                    <div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/15 text-sm font-bold">
                            AI
                        </div>
                        <h1 class="mt-8 text-4xl font-bold leading-tight">AI Konseling</h1>
                        <p class="mt-4 max-w-sm text-sm leading-relaxed text-teal-50">
                            Ruang dukungan awal yang dibuat untuk membantu pengguna bercerita dengan lebih tenang dan terarah.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-white/15 bg-white/10 p-5">
                        <p class="text-sm leading-relaxed text-teal-50">
                            "Mulai dari satu kalimat. Kadang yang paling membantu adalah punya ruang untuk mengurai."
                        </p>
                    </div>
                </section>

                <main class="px-6 py-8 sm:px-10">
                    <div class="mb-8 lg:hidden">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-teal-700 text-sm font-bold text-white">
                            AI
                        </div>
                        <h1 class="mt-4 text-2xl font-bold">AI Konseling</h1>
                    </div>

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
