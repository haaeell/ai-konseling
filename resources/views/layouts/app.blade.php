<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'AI Konseling' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f6f3ec] text-stone-800 antialiased">
    <div class="min-h-screen bg-[linear-gradient(135deg,#f6f3ec_0%,#eef5ee_48%,#f7f0e4_100%)]">
        <nav class="sticky top-0 z-30 px-3 pt-3 sm:px-5">
            <div class="mx-auto flex max-w-7xl items-center justify-between rounded-[28px] border border-stone-200/80 bg-[#fbfaf6]/90 px-3 py-3 shadow-xl shadow-stone-900/5 backdrop-blur-xl sm:px-4">
                <a href="{{ route('dashboard') }}" class="flex min-w-0 items-center gap-3">
                    <span class="relative flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-teal-800 text-sm font-black text-white shadow-sm">
                        AI
                        <span class="absolute -right-0.5 -top-0.5 h-3 w-3 rounded-full border-2 border-[#fbfaf6] bg-emerald-400"></span>
                    </span>
                    <span class="min-w-0">
                        <span class="block truncate text-base font-black leading-tight text-stone-950">AI Konseling</span>
                        <span class="hidden text-xs font-medium text-stone-500 sm:block">
                            {{ auth()->check() && auth()->user()->isAdmin() ? 'Panel konselor' : 'Ruang dukungan awal' }}
                        </span>
                    </span>
                </a>

                @auth
                    <div class="hidden items-center rounded-full border border-stone-200 bg-white/75 p-1 text-sm shadow-sm md:flex">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.sessions.index') }}"
                                class="rounded-full px-4 py-2 font-bold transition {{ request()->routeIs('admin.sessions.*') ? 'bg-teal-800 text-white shadow-sm' : 'text-stone-600 hover:text-teal-800' }}">
                                Sesi
                            </a>
                            <a href="{{ route('admin.users.index') }}"
                                class="rounded-full px-4 py-2 font-bold transition {{ request()->routeIs('admin.users.*') ? 'bg-teal-800 text-white shadow-sm' : 'text-stone-600 hover:text-teal-800' }}">
                                User
                            </a>
                            <a href="{{ route('admin.settings.edit') }}"
                                class="rounded-full px-4 py-2 font-bold transition {{ request()->routeIs('admin.settings.*') ? 'bg-teal-800 text-white shadow-sm' : 'text-stone-600 hover:text-teal-800' }}">
                                Pengaturan
                            </a>
                        @else
                            <a href="{{ route('wellness.index') }}"
                                class="rounded-full px-4 py-2 font-bold transition {{ request()->routeIs('wellness.*') ? 'bg-teal-800 text-white shadow-sm' : 'text-stone-600 hover:text-teal-800' }}">
                                Ruang Tenang
                            </a>
                            <a href="{{ route('chat.index') }}"
                                class="rounded-full px-4 py-2 font-bold transition {{ request()->routeIs('chat.*') ? 'bg-teal-800 text-white shadow-sm' : 'text-stone-600 hover:text-teal-800' }}">
                                Chat AI
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('profile.edit') }}" class="hidden items-center gap-3 rounded-full border border-stone-200 bg-white/75 py-1.5 pl-2 pr-4 shadow-sm transition hover:bg-white lg:flex">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-stone-900 text-xs font-black text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="max-w-32 truncate text-sm font-bold text-stone-700">{{ auth()->user()->name }}</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                            @csrf
                            <button class="rounded-full border border-rose-100 bg-rose-50 px-4 py-2.5 text-sm font-bold text-rose-700 transition hover:bg-rose-100">
                                Keluar
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </nav>

        <main class="mx-auto max-w-7xl px-4 pb-24 pt-6 sm:px-6 sm:pb-6 lg:py-8">
            @if(session('success'))
                <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800 shadow-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            {{ $slot }}
        </main>

        @auth
            <nav class="fixed inset-x-3 bottom-3 z-40 rounded-[24px] border border-stone-200 bg-[#fbfaf6]/95 p-2 shadow-2xl shadow-stone-900/10 backdrop-blur sm:hidden">
                <div class="grid grid-cols-3 gap-2 text-center text-xs font-bold">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.sessions.index') }}"
                            class="rounded-2xl px-3 py-3 {{ request()->routeIs('admin.sessions.*') ? 'bg-teal-700 text-white' : 'text-stone-600' }}">
                            Sesi
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                            class="rounded-2xl px-3 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-teal-700 text-white' : 'text-stone-600' }}">
                            User
                        </a>
                        <a href="{{ route('admin.settings.edit') }}"
                            class="rounded-2xl px-3 py-3 {{ request()->routeIs('admin.settings.*') ? 'bg-teal-700 text-white' : 'text-stone-600' }}">
                            Atur
                        </a>
                    @else
                        <a href="{{ route('wellness.index') }}"
                            class="rounded-2xl px-3 py-3 {{ request()->routeIs('wellness.*') ? 'bg-teal-700 text-white' : 'text-stone-600' }}">
                            Ruang
                        </a>
                        <a href="{{ route('chat.index') }}"
                            class="rounded-2xl px-3 py-3 {{ request()->routeIs('chat.*') ? 'bg-teal-700 text-white' : 'text-stone-600' }}">
                            Chat
                        </a>
                        <a href="{{ route('profile.edit') }}"
                            class="rounded-2xl px-3 py-3 {{ request()->routeIs('profile.*') ? 'bg-teal-700 text-white' : 'text-stone-600' }}">
                            Profil
                        </a>
                    @endif
                </div>
            </nav>
        @endauth
    </div>
</body>

</html>
