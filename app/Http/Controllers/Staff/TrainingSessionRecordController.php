<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\TrainingSessionRecord;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;

class TrainingSessionRecordController extends Controller
{
    public function index()
    {
        $query = TrainingSessionRecord::query();

        if ($branch = request()->query('branch')) {
            $query->where('branch', $branch);
        }

        if ($pitch = request()->query('training_pitch')) {
            $query->where('training_pitch', $pitch);
        }

        if ($coachId = request()->query('coach_id')) {
            $query->where('coach_id', $coachId);
        }

        if ($date = request()->query('date')) {
            $query->whereDate('date', $date);
        }

        $records = $query->orderBy('date', 'desc')->paginate(15)->withQueryString();

        $sessions = TrainingSession::orderBy('date', 'desc')->get(['id','date','location','group_name']);
        $branches = $sessions->pluck('location')->filter()->unique()->values();
        $pitches = $sessions->pluck('group_name')->filter()->unique()->values();

        $coaches = [];
        try {
            $coaches = User::role('coach')->select('id','name')->orderBy('name')->get();
        } catch (\Throwable $e) {
            $coaches = User::select('id','name')->orderBy('name')->get();
        }

        return view('admin.training_session_records.index', compact('records', 'branches', 'pitches', 'coaches'));
    }
}
