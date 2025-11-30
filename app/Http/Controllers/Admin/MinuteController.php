<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Minute;
use Illuminate\Http\Request;

class MinuteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Minute::latest();

        // Filter by status if requested
        if (request('status')) {
            $query->where('status', request('status'));
        }

        $minutes = $query->paginate(10);
        return view('admin.minutes.index', compact('minutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.minutes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'starting_time' => 'required',
            'end_time' => 'required',
            'venue' => 'required|string',
            'chaired_by' => 'required|string',
            'note_taken_by' => 'required|string',
            'attendance_list' => 'array',
            'absent_apology' => 'array',
            'absent_no_apology' => 'array',
            'agenda' => 'required|string',
            'resolution' => 'string|nullable',
            'responsible_person' => 'string|nullable',
            'start_date' => 'date|nullable',
            'competition_date' => 'date|nullable',
        ]);

        $data['status'] = 'scheduled';

        Minute::create($data);

        return redirect()->route('admin.minutes.index')->with('success', 'Minutes created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Minute $minute)
    {
        return view('admin.minutes.show', compact('minute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Minute $minute)
    {
        return view('admin.minutes.edit', compact('minute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Minute $minute)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'starting_time' => 'required',
            'end_time' => 'required',
            'venue' => 'required|string',
            'chaired_by' => 'required|string',
            'note_taken_by' => 'required|string',
            'attendance_list' => 'array',
            'absent_apology' => 'array',
            'absent_no_apology' => 'array',
            'agenda' => 'required|string',
            'resolution' => 'string|nullable',
            'responsible_person' => 'string|nullable',
            'start_date' => 'date|nullable',
            'competition_date' => 'date|nullable',
        ]);

        $minute->update($data);

        return redirect()->route('admin.minutes.index')->with('success', 'Minutes updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Minute $minute)
    {
        $minute->delete();
        return redirect()->route('admin.minutes.index')->with('success', 'Minutes deleted successfully.');
    }

    /**
     * Mark minutes as completed
     */
    public function markCompleted(Minute $minute)
    {
        if (!$minute->isScheduled()) {
            return back()->with('error', 'Only scheduled minutes can be marked as completed.');
        }

        $minute->markCompleted();

        return back()->with('success', 'Minutes marked as completed.');
    }

    /**
     * Mark minutes as cancelled
     */
    public function markCancelled(Minute $minute)
    {
        if ($minute->isCancelled()) {
            return back()->with('error', 'These minutes are already cancelled.');
        }

        $minute->markCancelled();

        return back()->with('success', 'Minutes cancelled successfully.');
    }

    /**
     * Reschedule minutes
     */
    public function reschedule(Minute $minute)
    {
        $minute->reschedule();

        return back()->with('success', 'Minutes rescheduled.');
    }
}
