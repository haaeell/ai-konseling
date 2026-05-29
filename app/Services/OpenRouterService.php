<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class OpenRouterService
{
    public function ask(array $messages): array
    {
        try {
            $model = (string) config('openrouter.model');
            $apiKey = (string) config('openrouter.api_key');

            if ($apiKey === '') {
                return [
                    'ok' => false,
                    'message' => null,
                    'error' => 'Konfigurasi AI belum lengkap. OPENROUTER_API_KEY belum diatur.',
                ];
            }

            $response = Http::timeout(40)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'HTTP-Referer' => config('openrouter.site_url'),
                    'X-Title' => config('openrouter.app_name'),
                    'Content-Type' => 'application/json',
                ])
                ->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => $model,
                    'messages' => $messages,
                    'temperature' => 0.7,
                    'max_tokens' => 700,
                ]);

            if (! $response->successful()) {
                $errorMessage = (string) $response->json('error.message', '');

                Log::error('OpenRouter error', [
                    'status' => $response->status(),
                    'model' => $model,
                    'error_message' => $errorMessage,
                    'body' => $response->body(),
                ]);

                return [
                    'ok' => false,
                    'message' => null,
                    'error' => $this->mapHttpError($response->status(), $errorMessage, $model),
                ];
            }

            $content = $response->json('choices.0.message.content');

            if (! is_string($content) || trim($content) === '') {
                Log::warning('OpenRouter returned empty content', [
                    'model' => $model,
                    'body' => $response->body(),
                ]);

                return [
                    'ok' => false,
                    'message' => null,
                    'error' => 'AI merespons tanpa isi. Silakan coba kirim ulang pesan Anda.',
                ];
            }

            return [
                'ok' => true,
                'message' => $content,
                'error' => null,
            ];
        } catch (Throwable $e) {
            Log::error('OpenRouter exception', [
                'message' => $e->getMessage(),
            ]);

            return [
                'ok' => false,
                'message' => null,
                'error' => 'Koneksi ke layanan AI sedang bermasalah. Silakan coba lagi beberapa saat.',
            ];
        }
    }

    private function mapHttpError(int $status, string $errorMessage, string $model): string
    {
        if ($status === 401 || $status === 403) {
            return 'Autentikasi ke layanan AI gagal. Periksa kembali API key OpenRouter.';
        }

        if ($status === 404 && Str::contains(strtolower($errorMessage), 'no endpoints found')) {
            return "Model AI yang dipakai saat ini tidak tersedia: {$model}. Silakan ganti model OpenRouter di konfigurasi.";
        }

        if ($status === 404) {
            return 'Endpoint layanan AI tidak ditemukan. Periksa konfigurasi OpenRouter yang digunakan.';
        }

        if (in_array($status, [402, 429], true)) {
            return 'Batas penggunaan AI sedang tercapai atau kredit OpenRouter habis. Silakan coba lagi nanti.';
        }

        if ($status >= 500) {
            return 'Layanan AI sedang mengalami gangguan dari server penyedia. Silakan coba lagi beberapa saat.';
        }

        if ($errorMessage !== '') {
            return 'AI gagal merespons: ' . $errorMessage;
        }

        return 'AI sedang mengalami gangguan. Silakan coba lagi beberapa saat.';
    }
}
