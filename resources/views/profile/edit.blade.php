<x-app-layout>
    <x-slot name="title">Profil Akun</x-slot>

    <div class="mb-6">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Akun</p>
        <h1 class="mt-1 text-3xl font-bold text-stone-950">Profil Akun</h1>
        <p class="mt-2 max-w-2xl text-sm leading-relaxed text-stone-500">
            Kelola informasi dasar, password, dan pengaturan keamanan akun.
        </p>
    </div>

    <div class="grid gap-5 lg:grid-cols-3">
        <div class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm lg:col-span-2">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
            @include('profile.partials.update-password-form')
        </div>

        <div class="rounded-[28px] border border-rose-200 bg-rose-50/70 p-5 shadow-sm lg:col-span-3">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
