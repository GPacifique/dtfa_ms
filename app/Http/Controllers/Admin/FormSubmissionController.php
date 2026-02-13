<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use App\Models\Staff;
use App\Jobs\SendFormSubmissionNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FormSubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of form submissions.
     */
    public function index()
    {
        $submissions = FormSubmission::with('submitter', 'assignedStaff')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.form-submissions.index', compact('submissions'));
    }

    /**
     * Display the specified form submission.
     */
    public function show(FormSubmission $formSubmission)
    {
        $formSubmission->markAsRead();

        return view('admin.form-submissions.show', compact('formSubmission'));
    }

    /**
     * Store a form submission from user form.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'form_type' => 'required|string|in:contact,complaint,feedback,incident,suggestion,other',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
            'form_data' => 'nullable|array',
        ]);

        // If user is authenticated, store their ID
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        $formSubmission = FormSubmission::create($data);

        // Dispatch job to send notifications to staff and submitter
        SendFormSubmissionNotifications::dispatch($formSubmission);

        return response()->json([
            'success' => true,
            'message' => 'Your submission has been received. We will respond shortly.',
            'submission_id' => $formSubmission->id,
        ]);
    }

    /**
     * Mark submission as read.
     */
    public function markAsRead(FormSubmission $formSubmission)
    {
        $formSubmission->markAsRead();
        return back()->with('success', 'Marked as read.');
    }

    /**
     * Assign submission to a staff member.
     */
    public function assign(Request $request, FormSubmission $formSubmission)
    {
        $data = $request->validate([
            'assigned_to' => 'required|exists:staff,id',
        ]);

        $formSubmission->update(['assigned_to' => $data['assigned_to']]);

        return back()->with('success', 'Assigned successfully.');
    }

    /**
     * Update the status of a submission.
     */
    public function updateStatus(Request $request, FormSubmission $formSubmission)
    {
        $data = $request->validate([
            'status' => 'required|in:received,read,acknowledged,resolved',
            'notes' => 'nullable|string',
        ]);

        if ($data['status'] === 'acknowledged' || $data['status'] === 'resolved') {
            $formSubmission->markAsResponded();
        }

        $formSubmission->update([
            'status' => $data['status'],
            'notes' => $data['notes'] ?? $formSubmission->notes,
        ]);

        return back()->with('success', 'Status updated successfully.');
    }

    /**
     * Delete a form submission.
     */
    public function destroy(FormSubmission $formSubmission)
    {
        $formSubmission->delete();

        return back()->with('success', 'Submission deleted successfully.');
    }
}
