<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * SessionsController - Redirects to TrainingSessionRecordsController
 *
 * This controller is deprecated. All sessions functionality has been moved
 * to TrainingSessionRecordsController. These methods redirect to maintain
 * backwards compatibility with old URLs/bookmarks.
 */
class SessionsController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.training_session_records.index');
    }

    public function create()
    {
        return redirect()->route('admin.training_session_records.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.training_session_records.index');
    }

    public function show($session)
    {
        return redirect()->route('admin.training_session_records.show', $session);
    }

    public function edit($session)
    {
        return redirect()->route('admin.training_session_records.edit', $session);
    }

    public function update(Request $request, $session)
    {
        return redirect()->route('admin.training_session_records.index');
    }

    public function destroy($session)
    {
        return redirect()->route('admin.training_session_records.index');
    }

    public function attendance($session)
    {
        return redirect()->route('admin.training_session_records.index');
    }

    public function storeAttendance(Request $request, $session)
    {
        return redirect()->route('admin.training_session_records.index');
    }

    public function exportAttendanceCsv($session)
    {
        return redirect()->route('admin.training_session_records.index');
    }

    public function recordAllAttendance($session)
    {
        return redirect()->route('admin.training_session_records.index');
    }
}
