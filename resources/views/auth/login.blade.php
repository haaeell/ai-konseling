<x-guest-layout>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Masuk</p>
        <h1 class="mt-2 text-2xl font-bold text-stone-950">Selamat datang kembali</h1>
        <p class="mt-2 text-sm leading-relaxed text-stone-500">Masuk untuk melanjutkan sesi konseling atau memantau percakapan pengguna.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-stone-300 text-teal-700 shadow-sm focus:ring-teal-500" name="remember">
            <span class="ms-2 text-sm text-stone-600">{{ __('Remember me') }}</span>
        </label>

        <div class="flex items-center justify-between gap-4 pt-2">
            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-teal-700 hover:text-teal-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
