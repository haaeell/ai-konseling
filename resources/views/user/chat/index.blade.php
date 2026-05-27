<x-app-layout>
    <x-slot name="title">Ruang Konseling</x-slot>

    <div class="grid gap-3 lg:gap-5 lg:grid-cols-[300px_1fr]">
        <aside class="rounded-[28px] border border-stone-200 bg-[#fbfaf6]/90 p-3 shadow-sm sm:p-4">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Ruang Sesi</p>
                    <h2 class="mt-1 text-base font-bold text-stone-900 sm:text-lg">Riwayat Percakapan</h2>
                </div>

                <form method="POST" action="{{ route('chat.new') }}">
                    @csrf
                    <button class="rounded-2xl bg-teal-700 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-teal-800 sm:px-4">
                        + Baru
                    </button>
                </form>
            </div>

            <div class="-mx-1 flex gap-2 overflow-x-auto px-1 pb-1 lg:mx-0 lg:block lg:max-h-[calc(100vh-230px)] lg:space-y-2 lg:overflow-y-auto lg:overflow-x-visible lg:px-0 lg:pb-0 lg:pr-1">
                @foreach($sessions as $session)
                    <a href="{{ route('chat.show', $session) }}"
                        class="block min-w-[190px] shrink-0 rounded-2xl border px-3 py-3 transition lg:min-w-0 lg:px-4
                            {{ $currentSession->id === $session->id
                                ? 'border-teal-200 bg-teal-50 text-teal-900'
                                : 'border-transparent bg-white/70 text-stone-700 hover:border-stone-200 hover:bg-white' }}">
                        <div class="truncate text-sm font-bold">{{ $session->title }}</div>
                        <div class="mt-1 truncate text-xs text-stone-500">
                            {{ $session->created_at->format('d M Y H:i') }}
                        </div>
                    </a>
                @endforeach
            </div>
        </aside>

        <section id="mobile-chat-shell" class="flex min-h-0 flex-col overflow-hidden rounded-[32px] border border-stone-200 bg-[#fbfaf6] shadow-sm">
            <header class="shrink-0 border-b border-stone-200 bg-white/90 px-4 py-4 sm:px-5 sm:py-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Sesi Aktif</p>
                        <h1 id="chat-title" class="mt-1 text-xl font-bold leading-tight text-stone-950 sm:truncate sm:text-2xl">{{ $currentSession->title }}</h1>
                        <p id="chat-status" class="mt-1 text-sm leading-relaxed text-stone-500">Ceritakan pelan-pelan. Kamu tidak harus merapikan semuanya sekaligus.</p>
                    </div>
                    <div class="hidden rounded-2xl border border-teal-100 bg-teal-50 px-4 py-3 text-right sm:block">
                        <p class="text-xs text-teal-700">Mode</p>
                        <p class="text-sm font-bold text-teal-900">Dukungan awal</p>
                    </div>
                </div>
            </header>

            <div id="chat-messages" class="min-h-[320px] flex-1 space-y-4 overflow-y-auto bg-[linear-gradient(180deg,#fbfaf6,#f2efe7)] px-3 py-4 sm:min-h-0 sm:space-y-5 sm:px-8 sm:py-6">
                @forelse($currentSession->messages as $message)
                    <div class="flex {{ $message->sender === 'user' ? 'justify-end' : 'justify-start' }}" data-message-id="{{ $message->id }}">
                        <div class="max-w-[92%] rounded-[24px] px-4 py-3 text-sm leading-relaxed shadow-sm sm:max-w-[72%] sm:px-5 sm:py-4
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
                    <div id="empty-chat" class="mx-auto mt-10 max-w-lg rounded-[28px] border border-stone-200 bg-white px-5 py-5 text-center shadow-sm sm:mt-14 sm:px-6">
                        <p class="text-base font-bold text-stone-900">Mulai dari hal yang paling terasa hari ini.</p>
                        <p class="mt-2 text-sm leading-relaxed text-stone-500">Tidak perlu langsung lengkap. Satu kalimat pendek juga cukup untuk memulai.</p>
                    </div>
                @endforelse
            </div>

            <form id="chat-form" method="POST" action="{{ route('chat.store', $currentSession) }}" class="shrink-0 border-t border-stone-200 bg-white/95 px-3 py-3 pb-24 backdrop-blur transition-[padding,transform] sm:px-6 sm:py-4 sm:pb-4">
                @csrf

                <div class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-2 shadow-sm">
                    <div class="flex items-end gap-2 sm:gap-3">
                        <textarea id="message-input" name="message" rows="1" required maxlength="2000" placeholder="Tulis apa yang sedang kamu rasakan..."
                            class="max-h-36 min-h-[48px] flex-1 resize-none border-0 bg-transparent px-3 py-3 text-sm text-stone-800 placeholder:text-stone-400 focus:ring-0 sm:min-h-[52px]"></textarea>

                        <button id="send-button"
                            class="mb-1 shrink-0 rounded-2xl bg-teal-700 px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-teal-800 disabled:cursor-not-allowed disabled:bg-stone-300 sm:px-5"
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

    <style>
        body.chat-keyboard-open #mobile-bottom-nav,
        body.chat-input-focused #mobile-bottom-nav {
            transform: translateY(120%);
            opacity: 0;
            pointer-events: none;
        }

        @media (max-width: 639px) {
            body.chat-page main {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }

            #mobile-chat-shell {
                min-height: calc(100svh - 14.5rem);
            }

            body.chat-keyboard-open #chat-form {
                padding-bottom: 0.75rem;
            }

            body.chat-input-focused #chat-form {
                padding-bottom: 0.75rem;
            }

            body.chat-input-focused #mobile-chat-shell,
            body.chat-keyboard-open #mobile-chat-shell {
                min-height: calc(100svh - 10rem);
            }
        }
    </style>

    <script>
        (() => {
            document.body.classList.add('chat-page');

            const form = document.getElementById('chat-form');
            const input = document.getElementById('message-input');
            const messages = document.getElementById('chat-messages');
            const sendButton = document.getElementById('send-button');
            const status = document.getElementById('chat-status');
            const title = document.getElementById('chat-title');
            const token = form.querySelector('input[name="_token"]').value;
            const mobileBottomNav = document.getElementById('mobile-bottom-nav');

            const scrollToBottom = () => {
                messages.scrollTop = messages.scrollHeight;
            };

            const syncMobileViewport = () => {
                if (window.innerWidth >= 640) {
                    document.body.classList.remove('chat-keyboard-open');
                    document.body.classList.remove('chat-input-focused');
                    messages.style.height = '';
                    return;
                }

                const viewportHeight = window.visualViewport?.height ?? window.innerHeight;
                const keyboardOpen = window.visualViewport
                    ? window.innerHeight - window.visualViewport.height > 140
                    : false;

                document.body.classList.toggle('chat-keyboard-open', keyboardOpen);

                const headerHeight = messages.previousElementSibling?.offsetHeight ?? 0;
                const formHeight = form.offsetHeight ?? 0;
                const navOffset = keyboardOpen || !mobileBottomNav ? 16 : (mobileBottomNav.offsetHeight + 28);
                const availableHeight = Math.max(260, viewportHeight - headerHeight - formHeight - navOffset - 24);

                messages.style.height = `${availableHeight}px`;

                if (keyboardOpen) {
                    requestAnimationFrame(scrollToBottom);
                }
            };

            const resizeInput = () => {
                input.style.height = 'auto';
                input.style.height = `${Math.min(input.scrollHeight, 144)}px`;
                syncMobileViewport();
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
            input.addEventListener('focus', () => {
                document.body.classList.add('chat-input-focused');
                syncMobileViewport();
            });
            input.addEventListener('blur', () => {
                document.body.classList.remove('chat-input-focused');
                setTimeout(syncMobileViewport, 120);
            });
            scrollToBottom();
            resizeInput();
            syncMobileViewport();

            if (window.visualViewport) {
                window.visualViewport.addEventListener('resize', syncMobileViewport);
                window.visualViewport.addEventListener('scroll', syncMobileViewport);
            }

            window.addEventListener('resize', syncMobileViewport);

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
                    syncMobileViewport();
                }
            });
        })();
    </script>
</x-app-layout>
