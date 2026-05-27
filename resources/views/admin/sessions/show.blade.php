<x-app-layout>
    <x-slot name="title">Detail Sesi Konseling</x-slot>

    <div class="grid gap-5 lg:grid-cols-[360px_1fr]">
        <aside class="h-fit rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Detail Sesi</p>
            <h1 class="mt-1 text-2xl font-bold text-stone-950">{{ $session->title }}</h1>

            <div class="mt-5 space-y-4 rounded-3xl border border-stone-200 bg-white/70 p-4 text-sm">
                <div>
                    <div class="text-xs font-semibold uppercase tracking-[0.12em] text-stone-400">Nama User</div>
                    <div class="mt-1 font-bold text-stone-900">{{ $session->user->name }}</div>
                </div>

                <div>
                    <div class="text-xs font-semibold uppercase tracking-[0.12em] text-stone-400">Email</div>
                    <div class="mt-1 break-words font-medium text-stone-700">{{ $session->user->email }}</div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-2xl bg-teal-50 p-3">
                        <div class="text-xs text-teal-700">Status</div>
                        <div class="mt-1 font-bold text-teal-900">{{ str_replace('_', ' ', $session->status) }}</div>
                    </div>
                    <div class="rounded-2xl bg-amber-50 p-3">
                        <div class="text-xs text-amber-700">Risk</div>
                        <div class="mt-1 font-bold text-amber-900">{{ $session->risk_level }}</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.sessions.update', $session) }}" class="mt-5 space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="mb-2 block text-sm font-bold text-stone-800">Status</label>
                    <select name="status" class="w-full rounded-2xl border-stone-200 bg-white text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        @foreach(['active', 'follow_up', 'emergency', 'closed'] as $status)
                            <option value="{{ $status }}" @selected($session->status === $status)>
                                {{ str_replace('_', ' ', $status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-stone-800">Risk Level</label>
                    <select name="risk_level" class="w-full rounded-2xl border-stone-200 bg-white text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        @foreach(['low', 'medium', 'high'] as $risk)
                            <option value="{{ $risk }}" @selected($session->risk_level === $risk)>
                                {{ $risk }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="w-full rounded-2xl bg-teal-700 px-4 py-3 font-bold text-white shadow-sm transition hover:bg-teal-800">
                    Simpan Perubahan
                </button>
            </form>
        </aside>

        <section class="overflow-hidden rounded-[28px] border border-stone-200 bg-[#fbfaf6] shadow-sm">
            <div class="border-b border-stone-200 bg-white/70 px-5 py-4">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Percakapan</p>
                <h2 class="mt-1 text-xl font-bold text-stone-950">Isi Konseling</h2>
            </div>

            <div class="h-[72vh] space-y-5 overflow-y-auto bg-[linear-gradient(180deg,#fbfaf6,#f2efe7)] p-5">
                @foreach($session->messages as $message)
                    <div class="flex {{ $message->sender === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[88%] rounded-[24px] px-5 py-4 text-sm leading-relaxed shadow-sm sm:max-w-[72%]
                            {{ $message->sender === 'user'
                                ? 'rounded-tr-md bg-teal-700 text-white'
                                : ($message->sender === 'ai'
                                    ? 'rounded-tl-md border border-stone-200 bg-white text-stone-800'
                                    : 'rounded-tl-md bg-emerald-100 text-emerald-900') }}">
                            <div class="mb-2 text-xs font-bold uppercase tracking-[0.12em] {{ $message->sender === 'user' ? 'text-teal-100' : 'text-teal-700' }}">
                                {{ $message->sender === 'user' ? 'User' : ($message->sender === 'ai' ? 'AI Konseling' : 'Konselor') }}
                            </div>
                            <div class="break-words">{!! \App\Support\ChatMarkdown::render($message->message) !!}</div>
                            <div class="mt-3 text-right text-[11px] {{ $message->sender === 'user' ? 'text-teal-100' : 'text-stone-400' }}">
                                {{ $message->created_at->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
