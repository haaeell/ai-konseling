<x-guest-layout>
    <div class="mb-7">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Verifikasi Email</p>
        <h1 class="mt-2 text-2xl font-bold text-stone-950">Cek email kamu</h1>
        <p class="mt-2 text-sm leading-relaxed text-stone-500">
            Klik tautan verifikasi yang sudah dikirim. Kalau belum masuk, kamu bisa kirim ulang dari halaman ini.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm font-semibold text-rose-700 hover:text-rose-900">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
