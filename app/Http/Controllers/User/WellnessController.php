<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CounselingSession;

class WellnessController extends Controller
{
    public function index()
    {
        $recentSessions = CounselingSession::where('user_id', auth()->id())
            ->latest()
            ->limit(3)
            ->get();

        return view('user.wellness.index', compact('recentSessions'));
    }
}
