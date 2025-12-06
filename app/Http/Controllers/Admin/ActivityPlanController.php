<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityPlan;
use App\Models\Staff;
use Illuminate\Http\Request;

class ActivityPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if table exists (safety check for production)
        if (!\Illuminate\Support\Facades\Schema::hasTable('activity_plans')) {
            return back()->with('error', 'Activity Plans module is not available. Please run migrations.');
        }

        $query = ActivityPlan::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Filter by country
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        // Filter by focus area
        if ($request->filled('focus_area')) {
            $query->where('focus_area', $request->focus_area);
        }

        $activityPlans = $query->paginate(15);

        return view('admin.activity-plans.index', compact('activityPlans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $staff = Staff::all();
        $focusAreas = [
            'Sporting',
            'Administration and Finance',
            'Business',
            'Technology',
            'Capacity Building',
            'Social and Well Being'
        ];

        return view('admin.activity-plans.create', compact('staff', 'focusAreas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'country' => 'required|in:Rwanda,Tanzania',
            'challenge' => 'required|string|max:255',
            'opportunity' => 'required|string|max:255',
            'baseline' => 'required|string',
            'intervention_objective' => 'required|string',
            'list_of_activities' => 'required|string',
            'kpi' => 'required|string|max:255',
            'responsible_person_id' => 'required|exists:staff,id',
            'focus_area' => 'required|in:Sporting,Administration and Finance,Business,Technology,Capacity Building,Social and Well Being',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date|after:starting_date',
            'cost' => 'required|numeric|min:0',
            'financing_mechanism' => 'required|string|max:255',
            'status_remarks' => 'nullable|string',
        ]);

        // Convert activities string to array (newline separated)
        $validated['list_of_activities'] = array_filter(
            explode("\n", $request->list_of_activities),
            fn($item) => trim($item) !== ''
        );

        $validated['status'] = 'yellow'; // Default to ongoing

        ActivityPlan::create($validated);

        return redirect()->route('admin.activity-plans.index')
            ->with('success', 'Activity Plan created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityPlan $activityPlan)
    {
        $activityPlan->load('responsiblePerson');
        return view('admin.activity-plans.show', compact('activityPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ActivityPlan $activityPlan)
    {
        $staff = Staff::all();
        $focusAreas = [
            'Sporting',
            'Administration and Finance',
            'Business',
            'Technology',
            'Capacity Building',
            'Social and Well Being'
        ];

        return view('admin.activity-plans.edit', compact('activityPlan', 'staff', 'focusAreas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ActivityPlan $activityPlan)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:2000|max:2100',
            'country' => 'required|in:Rwanda,Tanzania',
            'challenge' => 'required|string|max:255',
            'opportunity' => 'required|string|max:255',
            'baseline' => 'required|string',
            'intervention_objective' => 'required|string',
            'list_of_activities' => 'required|string',
            'kpi' => 'required|string|max:255',
            'responsible_person_id' => 'required|exists:staff,id',
            'focus_area' => 'required|in:Sporting,Administration and Finance,Business,Technology,Capacity Building,Social and Well Being',
            'starting_date' => 'required|date',
            'ending_date' => 'required|date|after:starting_date',
            'cost' => 'required|numeric|min:0',
            'financing_mechanism' => 'required|string|max:255',
            'status_remarks' => 'nullable|string',
        ]);

        // Convert activities string to array (newline separated)
        $validated['list_of_activities'] = array_filter(
            explode("\n", $request->list_of_activities),
            fn($item) => trim($item) !== ''
        );

        $activityPlan->update($validated);

        return redirect()->route('admin.activity-plans.show', $activityPlan)
            ->with('success', 'Activity Plan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityPlan $activityPlan)
    {
        $activityPlan->delete();

        return redirect()->route('admin.activity-plans.index')
            ->with('success', 'Activity Plan deleted successfully!');
    }

    /**
     * Mark plan as not achieved (Red)
     */
    public function markNotAchieved(ActivityPlan $activityPlan)
    {
        $activityPlan->markNotAchieved();

        return redirect()->route('admin.activity-plans.show', $activityPlan)
            ->with('success', 'Plan marked as Not Achieved!');
    }

    /**
     * Mark plan as ongoing (Yellow)
     */
    public function markOngoing(ActivityPlan $activityPlan)
    {
        $activityPlan->markOngoing();

        return redirect()->route('admin.activity-plans.show', $activityPlan)
            ->with('success', 'Plan marked as Ongoing!');
    }

    /**
     * Mark plan as achieved (Green)
     */
    public function markAchieved(ActivityPlan $activityPlan)
    {
        $activityPlan->markAchieved();

        return redirect()->route('admin.activity-plans.show', $activityPlan)
            ->with('success', 'Plan marked as Achieved!');
    }
}
