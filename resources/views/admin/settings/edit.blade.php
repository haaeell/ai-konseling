<x-app-layout>
    <x-slot name="title">Pengaturan Konten</x-slot>

    <div class="mb-6">
        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Admin</p>
        <h1 class="mt-1 text-3xl font-bold text-stone-950">Pengaturan Konten</h1>
        <p class="mt-2 max-w-2xl text-sm leading-relaxed text-stone-500">
            Ubah prompt AI dan isi landing page tanpa perlu edit kode.
        </p>
    </div>

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-5">
        @csrf
        @method('PATCH')

        <section class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
            <div class="mb-4">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">AI</p>
                <h2 class="mt-1 text-xl font-bold text-stone-950">Prompt Konseling</h2>
                <p class="mt-1 text-sm text-stone-500">Prompt ini akan dipakai sebagai instruksi sistem setiap kali user mengirim chat.</p>
            </div>

            <textarea name="ai_system_prompt" rows="12"
                class="w-full rounded-3xl border-stone-200 bg-white p-4 text-sm leading-relaxed shadow-sm focus:border-teal-500 focus:ring-teal-500">{{ old('ai_system_prompt', $settings['ai_system_prompt']) }}</textarea>
            <x-input-error :messages="$errors->get('ai_system_prompt')" class="mt-2" />
        </section>

        <section class="rounded-[28px] border border-stone-200 bg-[#fbfaf6] p-5 shadow-sm">
            <div class="mb-4">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-teal-700">Landing Page</p>
                <h2 class="mt-1 text-xl font-bold text-stone-950">Konten Halaman Depan</h2>
                <p class="mt-1 text-sm text-stone-500">Bagian ini akan tampil di halaman publik sebelum login.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <x-input-label for="landing_badge" value="Badge Kecil" />
                    <x-text-input id="landing_badge" name="landing_badge" class="mt-2 block w-full" :value="old('landing_badge', $settings['landing_badge'])" />
                </div>

                <div>
                    <x-input-label for="landing_primary_cta" value="Teks Tombol Utama" />
                    <x-text-input id="landing_primary_cta" name="landing_primary_cta" class="mt-2 block w-full" :value="old('landing_primary_cta', $settings['landing_primary_cta'])" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="landing_title" value="Judul Hero" />
                    <x-text-input id="landing_title" name="landing_title" class="mt-2 block w-full" :value="old('landing_title', $settings['landing_title'])" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="landing_subtitle" value="Deskripsi Hero" />
                    <textarea id="landing_subtitle" name="landing_subtitle" rows="4"
                        class="mt-2 w-full rounded-3xl border-stone-200 bg-white p-4 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500">{{ old('landing_subtitle', $settings['landing_subtitle']) }}</textarea>
                </div>

                <div>
                    <x-input-label for="landing_secondary_cta" value="Teks Tombol Kedua" />
                    <x-text-input id="landing_secondary_cta" name="landing_secondary_cta" class="mt-2 block w-full" :value="old('landing_secondary_cta', $settings['landing_secondary_cta'])" />
                </div>
            </div>

            <div class="mt-6 grid gap-4 md:grid-cols-3">
                @for($i = 1; $i <= 3; $i++)
                    <div class="rounded-3xl border border-stone-200 bg-white p-4">
                        <h3 class="mb-3 font-bold text-stone-950">Fitur {{ $i }}</h3>
                        <x-input-label :for="'landing_feature_'.$i.'_title'" value="Judul" />
                        <x-text-input :id="'landing_feature_'.$i.'_title'" :name="'landing_feature_'.$i.'_title'" class="mt-2 block w-full" :value="old('landing_feature_'.$i.'_title', $settings['landing_feature_'.$i.'_title'])" />

                        <x-input-label :for="'landing_feature_'.$i.'_text'" value="Deskripsi" class="mt-4" />
                        <textarea id="landing_feature_{{ $i }}_text" name="landing_feature_{{ $i }}_text" rows="4"
                            class="mt-2 w-full rounded-2xl border-stone-200 bg-white p-3 text-sm shadow-sm focus:border-teal-500 focus:ring-teal-500">{{ old('landing_feature_'.$i.'_text', $settings['landing_feature_'.$i.'_text']) }}</textarea>
                    </div>
                @endfor
            </div>
        </section>

        <div class="sticky bottom-4 flex justify-end">
            <button class="rounded-2xl bg-teal-700 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-teal-900/10 transition hover:bg-teal-800">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</x-app-layout>
