<x-guest-layout>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Masuk</p>
        <h1 class="mt-2 text-2xl font-bold text-stone-950">Selamat datang kembali</h1>
        <p class="mt-2 text-sm leading-relaxed text-stone-500">Masuk untuk melanjutkan sesi, membuka riwayat percakapan, atau memantau pengguna jika Anda bertugas sebagai admin.</p>
        <div class="mt-4 rounded-3xl border border-stone-200 bg-stone-50 p-4 text-sm leading-relaxed text-stone-600">
            Gunakan email yang sudah terdaftar. Jika baru pertama kali menggunakan aplikasi, buat akun terlebih dahulu agar sesi Anda tersimpan dengan rapi.
        </div>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="'Email Terdaftar'" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="password" :value="'Kata Sandi'" />
                <span class="text-xs text-stone-400">Minimal sesuai yang Anda buat saat daftar</span>
            </div>
            <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-stone-300 text-teal-700 shadow-sm focus:ring-teal-500" name="remember">
            <span class="ms-2 text-sm text-stone-600">Tetap masuk di perangkat ini</span>
        </label>

        <div class="flex items-center justify-between gap-4 pt-2">
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-teal-700 hover:text-teal-900" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif

            <x-primary-button>
                Masuk ke Akun
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 rounded-3xl border border-teal-100 bg-teal-50 p-4 text-sm leading-relaxed text-teal-900">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-bold underline decoration-teal-400 underline-offset-4">Daftar di sini</a>
        untuk mulai membuat ruang percakapan pribadi.
    </div>
</x-guest-layout>
