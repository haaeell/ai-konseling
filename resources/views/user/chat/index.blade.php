<x-app-layout>
    <x-slot name="title">Ruang Konseling</x-slot>

    <div class="grid gap-5 lg:grid-cols-[300px_1fr]">
        <aside class="rounded-[28px] border border-stone-200 bg-[#fbfaf6]/90 p-4 shadow-sm">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Ruang Sesi</p>
                    <h2 class="mt-1 text-lg font-bold text-stone-900">Riwayat Percakapan</h2>
                </div>

                <form method="POST" action="{{ route('chat.new') }}">
                    @csrf
                    <button class="rounded-2xl bg-teal-700 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-800">
                        Baru
                    </button>
                </form>
            </div>

            <div class="max-h-[26vh] space-y-2 overflow-y-auto pr-1 lg:max-h-[calc(100vh-230px)]">
                @foreach($sessions as $session)
                    <a href="{{ route('chat.show', $session) }}"
                        class="block rounded-2xl border px-4 py-3 transition
                            {{ $currentSession->id === $session->id
                                ? 'border-teal-200 bg-teal-50 text-teal-900'
                                : 'border-transparent bg-white/70 text-stone-700 hover:border-stone-200 hover:bg-white' }}">
                        <div class="truncate text-sm font-bold">{{ $session->title }}</div>
                        <div class="mt-1 text-xs text-stone-500">
                            {{ $session->created_at->format('d M Y H:i') }}
                        </div>
                    </a>
                @endforeach
            </div>
        </aside>

        <section class="overflow-hidden rounded-[32px] border border-stone-200 bg-[#fbfaf6] shadow-sm">
            <header class="border-b border-stone-200 bg-white/70 px-5 py-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Sesi Aktif</p>
                        <h1 id="chat-title" class="mt-1 truncate text-2xl font-bold text-stone-950">{{ $currentSession->title }}</h1>
                        <p id="chat-status" class="mt-1 text-sm text-stone-500">Ceritakan pelan-pelan. Kamu tidak harus merapikan semuanya sekaligus.</p>
                    </div>
                    <div class="hidden rounded-2xl border border-teal-100 bg-teal-50 px-4 py-3 text-right sm:block">
                        <p class="text-xs text-teal-700">Mode</p>
                        <p class="text-sm font-bold text-teal-900">Dukungan awal</p>
                    </div>
                </div>
            </header>

            <div id="chat-messages" class="h-[58vh] space-y-5 overflow-y-auto bg-[linear-gradient(180deg,#fbfaf6,#f2efe7)] px-4 py-6 sm:px-8 lg:h-[62vh]">
                @forelse($currentSession->messages as $message)
                    <div class="flex {{ $message->sender === 'user' ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
                        <div class="max-w-[90%] rounded-[24px] px-5 py-4 text-sm leading-relaxed shadow-sm sm:max-w-[72%]
                            {{ $message->sender === 'user'
                                ? 'rounded-tr-md bg-teal-700 text-white'
                                : 'rounded-tl-md border border-stone-200 bg-white text-stone-800' }}">
                            <div class="mb-2 text-xs font-semibold {{ $message->sender === 'user' ? 'text-teal-100' : 'text-teal-700' }}">
                                {{ $message->sender === 'user' ? 'Kamu' : 'AI Konseling' }}
                            </div>
                            <div class="break-words">{!! \App\Support\ChatMarkdown::render($message->message) !!}</div>
                            <div class="mt-3 text-right text-[11px] {{ $message->sender === 'user' ? 'text-teal-100' : 'text-stone-400' }}">
                                {{ $message->created_at->format('H:i') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div id="empty-chat" class="mx-auto mt-14 max-w-lg rounded-[28px] border border-stone-200 bg-white px-6 py-5 text-center shadow-sm">
                        <p class="text-base font-bold text-stone-900">Mulai dari hal yang paling terasa hari ini.</p>
                        <p class="mt-2 text-sm leading-relaxed text-stone-500">Tidak perlu langsung lengkap. Satu kalimat pendek juga cukup untuk memulai.</p>
                    </div>
                @endforelse
            </div>

            <form id="chat-form" method="POST" action="{{ route('chat.store', $currentSession) }}" class="border-t border-stone-200 bg-white/80 px-4 py-4 sm:px-6">
                @csrf

                <div class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-2 shadow-sm">
                    <div class="flex items-end gap-3">
                        <textarea id="message-input" name="message" rows="1" required maxlength="2000" placeholder="Tulis apa yang sedang kamu rasakan..."
                            class="max-h-36 min-h-[52px] flex-1 resize-none border-0 bg-transparent px-3 py-3 text-sm text-stone-800 placeholder:text-stone-400 focus:ring-0"></textarea>

                        <button id="send-button"
                            class="mb-1 rounded-2xl bg-teal-700 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-teal-800 disabled:cursor-not-allowed disabled:bg-stone-300"
                            aria-label="Kirim pesan">
                            Kirim
                        </button>
                    </div>
                </div>

                <p class="mt-3 px-2 text-xs leading-relaxed text-stone-500">
                    Jika kamu merasa dalam bahaya atau ingin menyakiti diri, segera hubungi orang terpercaya atau layanan darurat terdekat.
                </p>
            </form>
        </section>
    </div>

    <script>
        (() => {
            const form = document.getElementById('chat-form');
            const input = document.getElementById('message-input');
            const messages = document.getElementById('chat-messages');
            const sendButton = document.getElementById('send-button');
            const status = document.getElementById('chat-status');
            const title = document.getElementById('chat-title');
            const token = form.querySelector('input[name="_token"]').value;

            const scrollToBottom = () => {
                messages.scrollTop = messages.scrollHeight;
            };

            const resizeInput = () => {
                input.style.height = 'auto';
                input.style.height = `${Math.min(input.scrollHeight, 144)}px`;
            };

            const escapeHtml = (value) => value
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');

            const renderMarkdown = (value) => escapeHtml(value)
                .replace(/\*\*(.+?)\*\*/gs, '<strong>$1</strong>')
                .replace(/\*(.+?)\*/gs, '<em>$1</em>')
                .replace(/\n/g, '<br>');

            const appendBubble = ({ sender, message, time, pending = false }) => {
                document.getElementById('empty-chat')?.remove();

                const row = document.createElement('div');
                row.className = `flex ${sender === 'user' ? 'justify-end' : 'justify-start'}`;

                const bubble = document.createElement('div');
                bubble.className = sender === 'user'
                    ? 'max-w-[90%] rounded-[24px] rounded-tr-md bg-teal-700 px-5 py-4 text-sm leading-relaxed text-white shadow-sm sm:max-w-[72%]'
                    : 'max-w-[90%] rounded-[24px] rounded-tl-md border border-stone-200 bg-white px-5 py-4 text-sm leading-relaxed text-stone-800 shadow-sm sm:max-w-[72%]';

                const label = document.createElement('div');
                label.className = sender === 'user' ? 'mb-2 text-xs font-semibold text-teal-100' : 'mb-2 text-xs font-semibold text-teal-700';
                label.textContent = sender === 'user' ? 'Kamu' : 'AI Konseling';

                const body = document.createElement('div');
                body.className = pending ? 'flex items-center gap-1.5 py-1' : 'whitespace-pre-line break-words';

                if (pending) {
                    for (let i = 0; i < 3; i++) {
                        const dot = document.createElement('span');
                        dot.className = 'h-2 w-2 animate-pulse rounded-full bg-teal-500';
                        dot.style.animationDelay = `${i * 120}ms`;
                        body.appendChild(dot);
                    }
                } else {
                    body.innerHTML = renderMarkdown(message);
                }

                const clock = document.createElement('div');
                clock.className = sender === 'user' ? 'mt-3 text-right text-[11px] text-teal-100' : 'mt-3 text-right text-[11px] text-stone-400';
                clock.textContent = time;

                bubble.append(label, body, clock);
                row.appendChild(bubble);
                messages.appendChild(row);
                scrollToBottom();

                return row;
            };

            const showError = (message) => {
                appendBubble({
                    sender: 'ai',
                    message,
                    time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                });
            };

            input.addEventListener('input', resizeInput);
            scrollToBottom();
            resizeInput();

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault();
                    form.requestSubmit();
                }
            });

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const message = input.value.trim();

                if (message.length < 2) {
                    return;
                }

                const now = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                appendBubble({ sender: 'user', message, time: now });

                input.value = '';
                resizeInput();
                input.focus();
                sendButton.disabled = true;
                status.textContent = 'AI sedang menyusun respons...';

                const typingBubble = appendBubble({
                    sender: 'ai',
                    message: '',
                    time: now,
                    pending: true,
                });

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: JSON.stringify({ message }),
                    });

                    const contentType = response.headers.get('content-type') ?? '';
                    const data = contentType.includes('application/json')
                        ? await response.json()
                        : null;

                    typingBubble.remove();

                    if (!response.ok || !data?.ok) {
                        if (response.status === 401) {
                            showError('Sesi login kamu sudah berakhir. Muat ulang halaman lalu login kembali.');
                            return;
                        }

                        if (response.status === 403) {
                            showError(data?.error ?? 'Sesi chat ini tidak bisa diakses. Muat ulang halaman lalu coba lagi.');
                            return;
                        }

                        showError(data?.error ?? 'AI belum bisa membalas saat ini. Silakan coba lagi.');
                        return;
                    }

                    appendBubble(data.ai_message);
                    title.textContent = data.session.title;
                } catch (error) {
                    typingBubble.remove();
                    showError('Koneksi chat bermasalah. Silakan coba lagi beberapa saat.');
                } finally {
                    sendButton.disabled = false;
                    status.textContent = 'Ceritakan pelan-pelan. Kamu tidak harus merapikan semuanya sekaligus.';
                }
            });
        })();
    </script>
</x-app-layout>
