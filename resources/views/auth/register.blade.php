<x-guest-layout>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Daftar</p>
        <h1 class="mt-2 text-2xl font-bold text-stone-950">Buat akun baru</h1>
        <p class="mt-2 text-sm leading-relaxed text-stone-500">Buat akun untuk menyimpan riwayat sesi, melanjutkan percakapan kapan saja, dan mengakses ruang dukungan awal dengan lebih nyaman.</p>
        <div class="mt-4 rounded-3xl border border-stone-200 bg-stone-50 p-4 text-sm leading-relaxed text-stone-600">
            Isi nama lengkap atau nama panggilan yang nyaman digunakan. Setelah akun dibuat, Anda bisa langsung mulai sesi pertama.
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="'Nama Pengguna'" />
            <x-text-input id="name" class="mt-2 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama lengkap atau nama panggilan" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="'Email Aktif'" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="password" :value="'Kata Sandi'" />
                <span class="text-xs text-stone-400">Gunakan kombinasi yang mudah Anda ingat</span>
            </div>
            <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="new-password" placeholder="Buat kata sandi" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="'Ulangi Kata Sandi'" />
            <x-text-input id="password_confirmation" class="mt-2 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-4 pt-2">
            <a class="text-sm font-semibold text-teal-700 hover:text-teal-900" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <x-primary-button>
                Buat Akun
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 rounded-3xl border border-amber-100 bg-amber-50 p-4 text-sm leading-relaxed text-amber-900">
        Setelah daftar, simpan email dan kata sandi Anda dengan baik agar mudah masuk kembali dan melanjutkan sesi berikutnya.
    </div>
</x-guest-layout>
