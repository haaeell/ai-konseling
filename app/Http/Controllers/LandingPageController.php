<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class LandingPageController extends Controller
{
    public function __invoke()
    {
        return view('welcome', [
            'settings' => $this->settings(),
        ]);
    }

    private function settings(): array
    {
        return collect(SiteSetting::defaults())
            ->except('ai_system_prompt')
            ->map(fn ($value, $key) => SiteSetting::getValue($key, $value))
            ->all();
    }
}
