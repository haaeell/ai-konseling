<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CounselingMessage;
use App\Models\CounselingSession;
use App\Models\SiteSetting;
use App\Services\OpenRouterService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $sessions = CounselingSession::where('user_id', auth()->id())
            ->latest()
            ->get();

        $currentSession = $sessions->first();

        if (! $currentSession) {
            $currentSession = CounselingSession::create([
                'user_id' => auth()->id(),
                'title' => 'Sesi Konseling Baru',
            ]);
        }

        $currentSession->load('messages');

        return view('user.chat.index', compact('sessions', 'currentSession'));
    }

    public function show(CounselingSession $session)
    {
        abort_if($session->user_id !== auth()->id(), 403);

        $sessions = CounselingSession::where('user_id', auth()->id())
            ->latest()
            ->get();

        $currentSession = $session->load('messages');

        return view('user.chat.index', compact('sessions', 'currentSession'));
    }

    public function store(Request $request, CounselingSession $session, OpenRouterService $ai)
    {
        abort_if($session->user_id !== auth()->id(), 403);

        $validated = $request->validate([
            'message' => ['required', 'string', 'min:2', 'max:2000'],
        ]);

        $message = trim($validated['message']);

        $userMessage = CounselingMessage::create([
            'counseling_session_id' => $session->id,
            'sender' => 'user',
            'message' => $message,
        ]);

        if ($session->title === 'Sesi Konseling Baru') {
            $session->update([
                'title' => str($message)->limit(40),
            ]);
        }

        $history = $session->messages()
            ->latest()
            ->limit(10)
            ->get()
            ->reverse()
            ->map(function ($chat) {
                return [
                    'role' => $chat->sender === 'user' ? 'user' : 'assistant',
                    'content' => $chat->message,
                ];
            })
            ->values()
            ->toArray();

        array_unshift($history, [
            'role' => 'system',
            'content' => SiteSetting::getValue('ai_system_prompt', SiteSetting::DEFAULT_AI_PROMPT),
        ]);

        $reply = $ai->ask($history);

        if ($reply['ok']) {
            $aiMessage = CounselingMessage::create([
                'counseling_session_id' => $session->id,
                'sender' => 'ai',
                'message' => $reply['message'],
            ]);
        }

        $this->detectRisk($session, $message);

        $redirect = redirect()->route('chat.show', $session);

        if (! $reply['ok']) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error' => $reply['error'],
                    'user_message' => $this->messagePayload($userMessage),
                    'session' => [
                        'id' => $session->id,
                        'title' => $session->fresh()->title,
                    ],
                ], 503);
            }

            return $redirect->with('error', $reply['error']);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'user_message' => $this->messagePayload($userMessage),
                'ai_message' => $this->messagePayload($aiMessage),
                'session' => [
                    'id' => $session->id,
                    'title' => $session->fresh()->title,
                ],
            ]);
        }

        return $redirect->with('success', 'Pesan berhasil dikirim.');
    }

    public function newSession()
    {
        $session = CounselingSession::create([
            'user_id' => auth()->id(),
            'title' => 'Sesi Konseling Baru',
            'status' => 'active',
            'risk_level' => 'low',
        ]);

        return redirect()->route('chat.show', $session);
    }

    private function detectRisk(CounselingSession $session, string $message): void
    {
        $keywords = [
            'bunuh diri',
            'mengakhiri hidup',
            'mati saja',
            'menyakiti diri',
            'self harm',
            'ingin mati',
            'dibunuh',
            'kekerasan',
        ];

        foreach ($keywords as $keyword) {
            if (str_contains(strtolower($message), $keyword)) {
                $session->update([
                    'status' => 'emergency',
                    'risk_level' => 'high',
                ]);

                return;
            }
        }
    }

    private function messagePayload(CounselingMessage $message): array
    {
        return [
            'id' => $message->id,
            'sender' => $message->sender,
            'message' => $message->message,
            'time' => $message->created_at->format('H:i'),
        ];
    }
}
