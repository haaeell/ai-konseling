<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public const DEFAULT_AI_PROMPT = <<<'PROMPT'
Kamu adalah AI Konseling yang bertugas membantu penanganan awal pengguna dengan aman, empatik, suportif, dan profesional.
Hanya jawab topik seputar konseling, stres, overthinking, kecemasan ringan, keluarga, hubungan, pekerjaan, emosi, motivasi, burnout, dan masalah pribadi ringan.
Jika pertanyaan di luar topik konseling, jawab:
"Maaf, saya hanya bisa membantu seputar konseling dan dukungan emosional."
Jangan memberi diagnosis medis.
Jangan mengaku sebagai psikolog, psikiater, atau dokter.
Jika ada indikasi bunuh diri, menyakiti diri, kekerasan, atau bahaya serius, sarankan segera menghubungi keluarga, orang terpercaya, profesional, atau layanan darurat terdekat.
Gunakan bahasa Indonesia yang hangat, pendek, natural, dan tidak menghakimi.
PROMPT;

    public static function defaults(): array
    {
        return [
            'ai_system_prompt' => self::DEFAULT_AI_PROMPT,
            'landing_badge' => 'Ruang dukungan awal berbasis AI',
            'landing_title' => 'Bercerita lebih ringan, satu langkah dalam satu waktu.',
            'landing_subtitle' => 'AI Konseling membantu pengguna memulai percakapan yang aman, hangat, dan terarah sebelum mendapatkan dukungan lanjutan dari orang terpercaya atau profesional.',
            'landing_primary_cta' => 'Mulai Chat',
            'landing_secondary_cta' => 'Masuk Admin',
            'landing_feature_1_title' => 'Percakapan Empatik',
            'landing_feature_1_text' => 'Respons AI dibuat singkat, suportif, dan tidak menghakimi agar pengguna merasa lebih nyaman memulai cerita.',
            'landing_feature_2_title' => 'Pemantauan Risiko',
            'landing_feature_2_text' => 'Admin dapat melihat sesi, status, dan tingkat risiko agar kasus penting lebih mudah dipantau.',
            'landing_feature_3_title' => 'Ruang Tenang',
            'landing_feature_3_text' => 'Pengguna mendapat alat bantu singkat seperti napas terarah, grounding, dan refleksi harian.',
        ];
    }

    public static function getValue(string $key, ?string $fallback = null): string
    {
        $default = $fallback ?? self::defaults()[$key] ?? '';

        return (string) (self::query()->where('key', $key)->value('value') ?? $default);
    }

    public static function setValue(string $key, ?string $value): void
    {
        self::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    public static function seedDefaults(): void
    {
        foreach (self::defaults() as $key => $value) {
            self::query()->firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
