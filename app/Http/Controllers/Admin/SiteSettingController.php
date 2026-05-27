<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit', [
            'settings' => $this->settings(),
        ]);
    }

    public function update(Request $request)
    {
        $keys = array_keys(SiteSetting::defaults());

        $validated = $request->validate(
            collect($keys)
                ->mapWithKeys(fn ($key) => [$key => ['nullable', 'string', 'max:8000']])
                ->all()
        );

        foreach ($keys as $key) {
            SiteSetting::setValue($key, $validated[$key] ?? '');
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }

    private function settings(): array
    {
        return collect(SiteSetting::defaults())
            ->map(fn ($value, $key) => SiteSetting::getValue($key, $value))
            ->all();
    }
}
