<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AI Konseling') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f6f3ec] text-stone-900 antialiased">
    <main class="min-h-screen overflow-hidden bg-[linear-gradient(135deg,#f6f3ec_0%,#eef5ee_44%,#f7f0e4_100%)]">
        <nav class="mx-auto max-w-7xl px-3 pt-3 sm:px-5">
            <div class="flex items-center justify-between rounded-[28px] border border-stone-200/80 bg-[#fbfaf6]/85 px-3 py-3 shadow-xl shadow-stone-900/5 backdrop-blur-xl sm:px-4">
                <a href="{{ route('landing') }}" class="flex min-w-0 items-center gap-3">
                    <span class="relative flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-teal-800 text-sm font-black text-white shadow-sm">
                        AI
                        <span class="absolute -right-0.5 -top-0.5 h-3 w-3 rounded-full border-2 border-[#fbfaf6] bg-emerald-400"></span>
                    </span>
                    <span class="min-w-0">
                        <span class="block truncate text-base font-black leading-tight">AI Konseling</span>
                        <span class="hidden text-xs font-medium text-stone-500 sm:block">Ruang dukungan awal</span>
                    </span>
                </a>

                <div class="flex items-center gap-2 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-full bg-teal-800 px-4 py-2.5 font-bold text-white shadow-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="rounded-full px-4 py-2.5 font-bold text-stone-700 transition hover:bg-white">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hidden rounded-full bg-teal-800 px-4 py-2.5 font-bold text-white shadow-sm transition hover:bg-teal-900 sm:inline-flex">
                            Daftar
                        </a>
                    @endif
                @endauth
                </div>
            </div>
        </nav>

        <section class="mx-auto grid max-w-7xl gap-8 px-5 pb-12 pt-6 sm:px-6 lg:grid-cols-[1.05fr_.95fr] lg:items-center lg:pb-20 lg:pt-12">
            <div>
                <p class="inline-flex rounded-full border border-teal-200 bg-white/70 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-teal-800">
                    {{ $settings['landing_badge'] }}
                </p>

                <h1 class="mt-5 max-w-4xl text-4xl font-black leading-[1.05] text-stone-950 sm:text-6xl">
                    {{ $settings['landing_title'] }}
                </h1>

                <p class="mt-5 max-w-2xl text-base leading-relaxed text-stone-600 sm:text-lg">
                    {{ $settings['landing_subtitle'] }}
                </p>

                <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                    @auth
                        <a href="{{ route('chat.index') }}" class="rounded-2xl bg-teal-800 px-6 py-4 text-center text-sm font-bold text-white shadow-lg shadow-teal-900/10 transition hover:bg-teal-900">
                            {{ $settings['landing_primary_cta'] }}
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="rounded-2xl bg-teal-800 px-6 py-4 text-center text-sm font-bold text-white shadow-lg shadow-teal-900/10 transition hover:bg-teal-900">
                            {{ $settings['landing_primary_cta'] }}
                        </a>
                    @endauth

                    <a href="{{ route('login') }}" class="rounded-2xl border border-stone-200 bg-white/75 px-6 py-4 text-center text-sm font-bold text-stone-800 transition hover:bg-white">
                        {{ $settings['landing_secondary_cta'] }}
                    </a>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-[36px] border border-stone-200 bg-[#fbfaf6] p-4 shadow-2xl shadow-stone-900/10">
                    <div class="rounded-[28px] bg-teal-800 p-5 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.16em] text-teal-100">Hari Ini</p>
                                <h2 class="mt-1 text-xl font-bold">Ruang Tenang</h2>
                            </div>
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold">Online</span>
                        </div>

                        <div class="mt-6 space-y-3">
                            <div class="max-w-[88%] rounded-3xl rounded-tl-md bg-white px-4 py-3 text-sm leading-relaxed text-stone-800">
                                Apa yang paling terasa berat hari ini?
                            </div>
                            <div class="ml-auto max-w-[86%] rounded-3xl rounded-tr-md bg-teal-100 px-4 py-3 text-sm leading-relaxed text-teal-950">
                                Aku merasa cemas dan sulit fokus.
                            </div>
                            <div class="max-w-[90%] rounded-3xl rounded-tl-md bg-white px-4 py-3 text-sm leading-relaxed text-stone-800">
                                Kita pelan-pelan ya. Coba mulai dari satu hal yang paling mengganggu pikiranmu.
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-3 pt-4 sm:grid-cols-3">
                        <div class="rounded-3xl bg-teal-50 p-4">
                            <p class="text-2xl font-black text-teal-900">4</p>
                            <p class="mt-1 text-xs text-teal-800">Latihan napas</p>
                        </div>
                        <div class="rounded-3xl bg-amber-50 p-4">
                            <p class="text-2xl font-black text-amber-900">3</p>
                            <p class="mt-1 text-xs text-amber-800">Fitur admin</p>
                        </div>
                        <div class="rounded-3xl bg-rose-50 p-4">
                            <p class="text-2xl font-black text-rose-900">24/7</p>
                            <p class="mt-1 text-xs text-rose-800">Akses awal</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto grid max-w-7xl gap-4 px-5 pb-14 sm:px-6 md:grid-cols-3">
            @for($i = 1; $i <= 3; $i++)
                <article class="rounded-[28px] border border-stone-200 bg-[#fbfaf6]/90 p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Fitur {{ $i }}</p>
                    <h2 class="mt-3 text-xl font-bold text-stone-950">{{ $settings['landing_feature_'.$i.'_title'] }}</h2>
                    <p class="mt-2 text-sm leading-relaxed text-stone-500">{{ $settings['landing_feature_'.$i.'_text'] }}</p>
                </article>
            @endfor
        </section>
    </main>
</body>

</html>
