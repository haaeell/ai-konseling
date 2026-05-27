<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AI Konseling') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f6f3ec] text-stone-900 antialiased">
    <main class="min-h-screen overflow-hidden bg-[radial-gradient(circle_at_top_left,#fdf6e8_0%,transparent_30%),radial-gradient(circle_at_top_right,#dff3ea_0%,transparent_28%),linear-gradient(135deg,#f6f3ec_0%,#eef5ee_48%,#f7f0e4_100%)]">
        <nav class="mx-auto max-w-7xl px-3 pt-3 sm:px-5">
            <div class="flex flex-wrap items-center justify-between gap-3 rounded-[28px] border border-stone-200/80 bg-[#fbfaf6]/85 px-3 py-3 shadow-xl shadow-stone-900/5 backdrop-blur-xl sm:px-4">
                <a href="{{ route('landing') }}" class="flex min-w-0 items-center gap-3">
                    <span class="relative flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-teal-800 text-sm font-black text-white shadow-sm">
                        AI
                        <span class="absolute -right-0.5 -top-0.5 h-3 w-3 rounded-full border-2 border-[#fbfaf6] bg-emerald-400"></span>
                    </span>
                    <span class="min-w-0">
                        <span class="block truncate text-base font-black leading-tight">AI Konseling</span>
                        <span class="hidden text-xs font-medium text-stone-500 sm:block">Ruang dukungan awal yang lebih tenang</span>
                    </span>
                </a>

                <div class="order-3 w-full rounded-2xl border border-stone-200/80 bg-white/70 p-2 sm:order-2 sm:w-auto sm:border-0 sm:bg-transparent sm:p-0">
                    <div class="grid grid-cols-2 gap-2 text-xs font-bold text-stone-600 sm:flex sm:flex-wrap sm:items-center sm:gap-2 sm:text-sm">
                        <a href="#beranda" class="inline-flex items-center justify-center gap-2 rounded-2xl px-3 py-2 transition hover:bg-white hover:text-teal-800">
                            <i class="fa-solid fa-house text-[0.9em]"></i>
                            <span>Beranda</span>
                        </a>
                        <a href="#fitur" class="inline-flex items-center justify-center gap-2 rounded-2xl px-3 py-2 transition hover:bg-white hover:text-teal-800">
                            <i class="fa-solid fa-sparkles text-[0.9em]"></i>
                            <span>Fitur</span>
                        </a>
                        <a href="#cara-kerja" class="inline-flex items-center justify-center gap-2 rounded-2xl px-3 py-2 transition hover:bg-white hover:text-teal-800">
                            <i class="fa-solid fa-compass text-[0.9em]"></i>
                            <span>Cara Kerja</span>
                        </a>
                        <a href="#mulai" class="inline-flex items-center justify-center gap-2 rounded-2xl px-3 py-2 transition hover:bg-white hover:text-teal-800">
                            <i class="fa-solid fa-arrow-up-right-from-square text-[0.9em]"></i>
                            <span>Mulai</span>
                        </a>
                    </div>
                </div>

                <div class="order-2 flex items-center gap-2 text-sm sm:order-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-full bg-teal-800 px-4 py-2.5 font-bold text-white shadow-sm">
                            <i class="fa-solid fa-table-columns text-[0.9em]"></i>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full px-4 py-2.5 font-bold text-stone-700 transition hover:bg-white">
                            <i class="fa-solid fa-right-to-bracket text-[0.9em]"></i>
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-teal-800 px-4 py-2.5 font-bold text-white shadow-sm transition hover:bg-teal-900">
                                <i class="fa-solid fa-user-plus text-[0.9em]"></i>
                                Buat Akun
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <section id="beranda" class="mx-auto grid max-w-7xl gap-10 px-5 pb-14 pt-6 sm:px-6 lg:grid-cols-[1.04fr_.96fr] lg:items-center lg:pb-20 lg:pt-12">
            <div>
                <p class="inline-flex rounded-full border border-teal-200 bg-white/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-teal-800 shadow-sm">
                    {{ $settings['landing_badge'] }}
                </p>

                <h1 class="mt-5 max-w-4xl text-4xl font-black leading-[0.98] text-stone-950 sm:text-6xl">
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

                    <a href="{{ route('login') }}" class="rounded-2xl border border-stone-200 bg-white/80 px-6 py-4 text-center text-sm font-bold text-stone-800 transition hover:bg-white">
                        {{ $settings['landing_secondary_cta'] }}
                    </a>
                </div>

                <div class="mt-7 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-3xl border border-stone-200 bg-white/75 p-4 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Privat</p>
                        <p class="mt-2 text-sm leading-relaxed text-stone-600">Mulai dari cerita singkat tanpa tekanan untuk langsung lengkap.</p>
                    </div>
                    <div class="rounded-3xl border border-stone-200 bg-white/75 p-4 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-amber-700">Terarah</p>
                        <p class="mt-2 text-sm leading-relaxed text-stone-600">Percakapan dibimbing pelan-pelan agar pengguna tidak merasa kewalahan.</p>
                    </div>
                    <div class="rounded-3xl border border-stone-200 bg-white/75 p-4 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-rose-700">Siap Pakai</p>
                        <p class="mt-2 text-sm leading-relaxed text-stone-600">Cocok untuk akses awal sebelum diarahkan ke bantuan lanjutan bila diperlukan.</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute -left-4 top-16 hidden h-24 w-24 rounded-full bg-amber-200/50 blur-2xl lg:block"></div>
                <div class="absolute -right-6 bottom-10 hidden h-28 w-28 rounded-full bg-teal-200/50 blur-2xl lg:block"></div>

                <div class="relative rounded-[36px] border border-stone-200 bg-[#fbfaf6] p-4 shadow-2xl shadow-stone-900/10">
                    <div class="rounded-[28px] bg-[linear-gradient(160deg,#0f766e,#115e59)] p-5 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs uppercase tracking-[0.16em] text-teal-100">Simulasi Ruang Chat</p>
                                <h2 class="mt-1 text-xl font-bold">Dukungan awal yang hangat</h2>
                            </div>
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold">Aktif</span>
                        </div>

                        <div class="mt-6 space-y-3">
                            <div class="max-w-[88%] rounded-3xl rounded-tl-md bg-white px-4 py-3 text-sm leading-relaxed text-stone-800">
                                Apa yang paling terasa berat hari ini?
                            </div>
                            <div class="ml-auto max-w-[86%] rounded-3xl rounded-tr-md bg-teal-100 px-4 py-3 text-sm leading-relaxed text-teal-950">
                                Aku sedang capek, susah fokus, dan merasa semua tugas menumpuk.
                            </div>
                            <div class="max-w-[90%] rounded-3xl rounded-tl-md bg-white px-4 py-3 text-sm leading-relaxed text-stone-800">
                                Kita urutkan satu per satu ya. Dari semua beban itu, mana yang paling mendesak untuk dibicarakan dulu?
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 grid gap-3 sm:grid-cols-3">
                        <div class="rounded-3xl bg-teal-50 p-4">
                            <p class="text-2xl font-black text-teal-900">24/7</p>
                            <p class="mt-1 text-xs text-teal-800">Akses awal kapan pun dibutuhkan</p>
                        </div>
                        <div class="rounded-3xl bg-amber-50 p-4">
                            <p class="text-2xl font-black text-amber-900">3 Langkah</p>
                            <p class="mt-1 text-xs text-amber-800">Masuk, cerita, lalu lanjutkan sesi</p>
                        </div>
                        <div class="rounded-3xl bg-rose-50 p-4">
                            <p class="text-2xl font-black text-rose-900">1 Ruang</p>
                            <p class="mt-1 text-xs text-rose-800">Untuk refleksi, emosi, dan dukungan awal</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="fitur" class="mx-auto max-w-7xl px-5 pb-6 sm:px-6">
            <div class="grid gap-4 md:grid-cols-3">
                @for($i = 1; $i <= 3; $i++)
                    <article class="rounded-[28px] border border-stone-200 bg-[#fbfaf6]/90 p-5 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Fitur {{ $i }}</p>
                        <h2 class="mt-3 text-xl font-bold text-stone-950">{{ $settings['landing_feature_'.$i.'_title'] }}</h2>
                        <p class="mt-2 text-sm leading-relaxed text-stone-500">{{ $settings['landing_feature_'.$i.'_text'] }}</p>
                    </article>
                @endfor
            </div>
        </section>

        <section id="cara-kerja" class="mx-auto max-w-7xl px-5 py-8 sm:px-6 lg:py-12">
            <div class="grid gap-5 lg:grid-cols-[.92fr_1.08fr]">
                <article class="rounded-[32px] border border-stone-200 bg-[#fffdf8]/95 p-6 shadow-sm sm:p-7">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Cara Kerja</p>
                    <h2 class="mt-3 text-3xl font-black leading-tight text-stone-950">Alur sederhana agar pengguna cepat mulai.</h2>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-3xl border border-stone-200 bg-white p-4">
                            <p class="text-sm font-bold text-stone-900">1. Buat akun atau masuk</p>
                            <p class="mt-1 text-sm leading-relaxed text-stone-500">Pengguna bisa mendaftar dengan nama, email, dan kata sandi untuk menyimpan riwayat sesi.</p>
                        </div>
                        <div class="rounded-3xl border border-stone-200 bg-white p-4">
                            <p class="text-sm font-bold text-stone-900">2. Mulai percakapan dari hal paling terasa</p>
                            <p class="mt-1 text-sm leading-relaxed text-stone-500">Tidak perlu cerita panjang di awal. Satu kalimat pendek sudah cukup untuk membuka sesi.</p>
                        </div>
                        <div class="rounded-3xl border border-stone-200 bg-white p-4">
                            <p class="text-sm font-bold text-stone-900">3. Lanjutkan sesi kapan saja</p>
                            <p class="mt-1 text-sm leading-relaxed text-stone-500">Riwayat percakapan membantu pengguna melanjutkan refleksi tanpa harus mengulang dari awal.</p>
                        </div>
                    </div>
                </article>

                <article class="rounded-[32px] border border-stone-200 bg-stone-950 p-6 text-white shadow-sm sm:p-7">
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-200">Penting Diketahui</p>
                    <h2 class="mt-3 text-3xl font-black leading-tight">AI ini untuk dukungan awal, bukan pengganti bantuan darurat.</h2>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                            <p class="text-sm font-bold text-white">Cocok untuk</p>
                            <p class="mt-2 text-sm leading-relaxed text-stone-300">Stres ringan, overthinking, emosi harian, burnout awal, dan kebutuhan untuk bercerita dengan lebih tenang.</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4">
                            <p class="text-sm font-bold text-white">Tidak menggantikan</p>
                            <p class="mt-2 text-sm leading-relaxed text-stone-300">Layanan medis, penanganan krisis, atau pertolongan darurat saat pengguna berada dalam bahaya.</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-4 sm:col-span-2">
                            <p class="text-sm font-bold text-white">Anjuran saat kondisi darurat</p>
                            <p class="mt-2 text-sm leading-relaxed text-stone-300">Jika pengguna ingin menyakiti diri, berada dalam ancaman, atau mengalami situasi krisis, segera hubungi orang terpercaya, tenaga profesional, atau layanan darurat terdekat.</p>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section id="mulai" class="mx-auto max-w-7xl px-5 pb-10 sm:px-6">
            <div class="rounded-[34px] border border-stone-200 bg-[#fbfaf6]/95 p-6 shadow-sm sm:p-8">
                <div class="grid gap-6 lg:grid-cols-[1fr_auto] lg:items-end">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Mulai Sekarang</p>
                        <h2 class="mt-3 text-3xl font-black leading-tight text-stone-950">Siapkan ruang dukungan digital yang lebih rapi, hangat, dan mudah dipakai.</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-stone-500 sm:text-base">
                            Landing page ini dirancang untuk mengarahkan pengguna dengan jelas: pahami layanan, buat akun, lalu mulai percakapan tanpa kebingungan.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('register') }}" class="rounded-2xl bg-teal-800 px-6 py-4 text-center text-sm font-bold text-white shadow-lg shadow-teal-900/10 transition hover:bg-teal-900">
                            Daftar dan Mulai
                        </a>
                        <a href="{{ route('login') }}" class="rounded-2xl border border-stone-200 bg-white px-6 py-4 text-center text-sm font-bold text-stone-800 transition hover:bg-stone-50">
                            Saya Sudah Punya Akun
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
