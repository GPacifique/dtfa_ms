<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\TrainingSession;
use Illuminate\Support\Carbon;

class GuestController extends Controller
{
    /**
     * Show a simple guest-facing dashboard with public info.
     */
    public function index(Request $request)
    {
        $today = Carbon::today()->toDateString();

        $branchesCount = Branch::count();

        $upcomingSessions = TrainingSession::with(['coach','branch','group'])
            ->whereDate('date', '>=', $today)
            ->orderBy('date')
            ->orderBy('start_time')
            ->limit(5)
            ->get();

        return view('guest.dashboard', [
            'branchesCount' => $branchesCount,
            'upcomingSessions' => $upcomingSessions,
        ]);
    }
}
