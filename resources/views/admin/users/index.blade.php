<x-app-layout>
    <x-slot name="title">Manajemen User</x-slot>

    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Admin</p>
            <h1 class="mt-1 text-3xl font-bold text-stone-950">Manajemen User</h1>
            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-stone-500">
                Lihat daftar pengguna, role, dan jumlah sesi konseling yang sudah dibuat.
            </p>
        </div>

        <div class="rounded-3xl border border-stone-200 bg-white/80 px-5 py-4 text-right shadow-sm">
            <p class="text-xs text-stone-500">Total halaman ini</p>
            <p class="text-2xl font-bold text-teal-800">{{ $users->count() }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-[28px] border border-stone-200 bg-[#fbfaf6] shadow-sm">
        <div class="grid gap-3 border-b border-stone-200 bg-white/70 px-5 py-4 text-xs font-semibold uppercase tracking-[0.14em] text-stone-500 lg:grid-cols-[1.3fr_1.5fr_.7fr_.8fr_1fr]">
            <div>Nama</div>
            <div>Email</div>
            <div>Role</div>
            <div>Jumlah Sesi</div>
            <div>Tanggal Daftar</div>
        </div>

        <div class="divide-y divide-stone-200">
            @foreach($users as $user)
                <div class="grid gap-3 px-5 py-4 text-sm transition hover:bg-white/70 lg:grid-cols-[1.3fr_1.5fr_.7fr_.8fr_1fr] lg:items-center">
                    <div class="font-bold text-stone-900">{{ $user->name }}</div>
                    <div class="break-words text-stone-600">{{ $user->email }}</div>
                    <div>
                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $user->role === 'admin' ? 'bg-teal-100 text-teal-800' : 'bg-stone-200 text-stone-700' }}">
                            {{ $user->role }}
                        </span>
                    </div>
                    <div class="font-bold text-stone-900">{{ $user->counseling_sessions_count }}</div>
                    <div class="text-stone-500">{{ $user->created_at->format('d M Y') }}</div>
                </div>
            @endforeach
        </div>

        <div class="border-t border-stone-200 bg-white/70 p-5">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
