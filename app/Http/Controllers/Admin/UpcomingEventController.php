<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingEvent;
use Illuminate\Http\Request;

class UpcomingEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = UpcomingEvent::latest();

        // Filter by status if requested
        if (request('status')) {
            $query->where('status', request('status'));
        }

        $events = $query->paginate(10);
        return view('admin.upcoming-events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.upcoming-events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_name' => 'required|string',
            'date' => 'required|date',
            'venue' => 'required|string',
            'starting_time' => 'required',
            'ending_time' => 'required',
            'objective' => 'required|string',
            'targeted_audience' => 'required|string',
            'coordinator_name' => 'required|string',
            'supporting_staff_names' => 'array',
            'is_paid' => 'boolean',
            'amount' => 'numeric|nullable',
            'currency' => 'string|nullable',
        ]);

        $data['status'] = 'upcoming';
        $data['currency'] = $data['currency'] ?? 'RWF';

        UpcomingEvent::create($data);

        return redirect()->route('admin.upcoming-events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UpcomingEvent $upcomingEvent)
    {
        return view('admin.upcoming-events.show', ['event' => $upcomingEvent]);
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit(UpcomingEvent $upcomingEvent)
    {
        return view('admin.upcoming-events.edit', ['event' => $upcomingEvent]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UpcomingEvent $upcomingEvent)
    {
        $data = $request->validate([
            'event_name' => 'required|string',
            'date' => 'required|date',
            'venue' => 'required|string',
            'starting_time' => 'required',
            'ending_time' => 'required',
            'objective' => 'required|string',
            'targeted_audience' => 'required|string',
            'coordinator_name' => 'required|string',
            'supporting_staff_names' => 'array',
            'is_paid' => 'boolean',
            'amount' => 'numeric|nullable',
            'currency' => 'string|nullable',
        ]);

        $data['currency'] = $data['currency'] ?? 'RWF';
        $upcomingEvent->update($data);

        return redirect()->route('admin.upcoming-events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UpcomingEvent $upcomingEvent)
    {
        $upcomingEvent->delete();
        return redirect()->route('admin.upcoming-events.index')->with('success', 'Event deleted successfully.');
    }

    /**
     * Mark event as ongoing
     */
    public function markOngoing(UpcomingEvent $upcomingEvent)
    {
        $upcomingEvent->markOngoing();
        return back()->with('success', 'Event marked as ongoing.');
    }

    /**
     * Mark event as completed
     */
    public function markCompleted(UpcomingEvent $upcomingEvent)
    {
        $upcomingEvent->markCompleted();
        return back()->with('success', 'Event marked as completed.');
    }

    /**
     * Mark event as cancelled
     */
    public function markCancelled(UpcomingEvent $upcomingEvent)
    {
        $upcomingEvent->markCancelled();
        return back()->with('success', 'Event cancelled.');
    }

    /**
     * Reschedule event
     */
    public function reschedule(UpcomingEvent $upcomingEvent)
    {
        $upcomingEvent->reschedule();
        return back()->with('success', 'Event rescheduled.');
    }
}
