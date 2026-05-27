<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CounselingSession;
use Illuminate\Http\Request;

class CounselingSessionController extends Controller
{
    public function index()
    {
        $sessions = CounselingSession::with(['user', 'messages'])
            ->latest()
            ->paginate(15);

        return view('admin.sessions.index', compact('sessions'));
    }

    public function show(CounselingSession $session)
    {
        $session->load(['user', 'messages']);

        return view('admin.sessions.show', compact('session'));
    }

    public function update(Request $request, CounselingSession $session)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:active,follow_up,emergency,closed'],
            'risk_level' => ['required', 'in:low,medium,high'],
        ]);

        $session->update($validated);

        return back()->with('success', 'Status sesi berhasil diperbarui.');
    }
}
