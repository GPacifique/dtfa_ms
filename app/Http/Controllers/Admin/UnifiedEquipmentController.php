<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\SportsEquipment;
use App\Models\OfficeEquipment;
use App\Models\TrainingEquipmentRequest;
use App\Models\EquipmentUsageReport;
use App\Models\TrainingSession;
use App\Models\InhouseTraining;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnifiedEquipmentController extends Controller
{
    /* ═══════════════════════════════════════════════════════════════════
     *  UNIFIED EQUIPMENT DASHBOARD
     * ═════════════════════════════════════════════════════════════════ */

    public function index(Request $request)
    {
        $tab    = $request->get('tab', 'general');
        $search = $request->get('search');
        $status = $request->get('status');
        $condition = $request->get('condition');
        $branchId = $request->get('branch_id');

        // General equipment
        $generalQuery = Equipment::with('branch');
        // Sports equipment
        $sportsQuery = SportsEquipment::with('branch');
        // Office equipment
        $officeQuery = OfficeEquipment::with('branch');

        foreach ([$generalQuery, $sportsQuery, $officeQuery] as $query) {
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }
            if ($status)    $query->where('status', $status);
            if ($condition) $query->where('condition', $condition);
            if ($branchId)  $query->where('branch_id', $branchId);
        }

        $general = $generalQuery->orderBy('name')->paginate(15, ['*'], 'general_page');
        $sports  = $sportsQuery->orderBy('name')->paginate(15, ['*'], 'sports_page');
        $office  = $officeQuery->orderBy('name')->paginate(15, ['*'], 'office_page');

        // Totals for dashboard cards
        $stats = [
            'general_total'   => Equipment::count(),
            'general_avail'   => Equipment::where('status', 'available')->count(),
            'sports_total'    => SportsEquipment::count(),
            'sports_avail'    => SportsEquipment::where('status', 'available')->count(),
            'office_total'    => OfficeEquipment::count(),
            'office_avail'    => OfficeEquipment::where('status', 'available')->count(),
            'pending_requests'=> TrainingEquipmentRequest::where('status', 'pending')->count(),
        ];

        $branches         = Branch::orderBy('name')->get();
        $recentRequests   = TrainingEquipmentRequest::with(['trainingSession', 'inhouseTraining', 'requestedBy'])
                                ->latest()
                                ->limit(5)
                                ->get();

        return view('admin.equipment.unified', compact(
            'general', 'sports', 'office', 'stats',
            'branches', 'tab', 'recentRequests'
        ));
    }

    /* ═══════════════════════════════════════════════════════════════════
     *  EQUIPMENT REQUESTS (per training schedule)
     * ═════════════════════════════════════════════════════════════════ */

    public function requests(Request $request)
    {
        $status   = $request->get('status');
        $type     = $request->get('training_type'); // 'session' | 'inhouse'

        $query = TrainingEquipmentRequest::with([
            'trainingSession.branch',
            'inhouseTraining.branch',
            'requestedBy',
            'approvedBy',
            'usageReport',
        ]);

        if ($status) $query->where('status', $status);
        if ($type === 'session')  $query->whereNotNull('training_session_id');
        if ($type === 'inhouse')  $query->whereNotNull('inhouse_training_id');

        $requests       = $query->latest()->paginate(20);
        $trainingSessions = TrainingSession::with('branch', 'group')->orderByDesc('date')->get();
        $inhouseTrainings = InhouseTraining::orderByDesc('training_date')->get();
        $allEquipment     = $this->getAllEquipmentList();

        return view('admin.equipment.requests', compact(
            'requests', 'trainingSessions', 'inhouseTrainings', 'allEquipment'
        ));
    }

    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'training_type'       => 'required|in:session,inhouse',
            'training_session_id' => 'required_if:training_type,session|nullable|exists:training_sessions,id',
            'inhouse_training_id' => 'required_if:training_type,inhouse|nullable|exists:inhouse_trainings,id',
            'equipment_type'      => 'required|in:general,sports,office',
            'equipment_id'        => 'required|integer',
            'quantity_requested'  => 'required|integer|min:1',
            'purpose'             => 'nullable|string|max:500',
            'notes'               => 'nullable|string|max:500',
        ]);

        // Validate equipment exists
        $equipment = $this->findEquipment($validated['equipment_type'], $validated['equipment_id']);
        if (!$equipment) {
            return back()->withErrors(['equipment_id' => 'Selected equipment not found.']);
        }

        // Check availability
        if ($equipment->available_quantity < $validated['quantity_requested']) {
            return back()->withErrors([
                'quantity_requested' => "Only {$equipment->available_quantity} units available.",
            ])->withInput();
        }

        TrainingEquipmentRequest::create([
            'training_session_id' => $validated['training_type'] === 'session' ? $validated['training_session_id'] : null,
            'inhouse_training_id' => $validated['training_type'] === 'inhouse' ? $validated['inhouse_training_id'] : null,
            'equipment_type'      => $validated['equipment_type'],
            'equipment_id'        => $validated['equipment_id'],
            'quantity_requested'  => $validated['quantity_requested'],
            'purpose'             => $validated['purpose'] ?? null,
            'notes'               => $validated['notes'] ?? null,
            'status'              => 'pending',
            'requested_by'        => Auth::id(),
        ]);

        return redirect()->route('admin.equipment.requests')
            ->with('success', 'Equipment request submitted successfully.');
    }

    public function approveRequest(Request $request, TrainingEquipmentRequest $equipmentRequest)
    {
        $validated = $request->validate([
            'quantity_approved' => 'required|integer|min:0',
            'notes'             => 'nullable|string|max:500',
        ]);

        $equipmentRequest->update([
            'quantity_approved' => $validated['quantity_approved'],
            'status'            => $validated['quantity_approved'] > 0 ? 'approved' : 'rejected',
            'notes'             => $validated['notes'] ?? $equipmentRequest->notes,
            'approved_by'       => Auth::id(),
            'approved_at'       => now(),
        ]);

        // Reserve quantity in inventory
        if ($equipmentRequest->status === 'approved') {
            $equipment = $this->findEquipment($equipmentRequest->equipment_type, $equipmentRequest->equipment_id);
            if ($equipment) {
                $newAvail = max(0, $equipment->available_quantity - $validated['quantity_approved']);
                $equipment->update(['available_quantity' => $newAvail, 'status' => $newAvail === 0 ? 'in_use' : $equipment->status]);
            }
        }

        return back()->with('success', 'Request updated successfully.');
    }

    public function rejectRequest(TrainingEquipmentRequest $equipmentRequest)
    {
        $equipmentRequest->update([
            'status'      => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);
        return back()->with('success', 'Request rejected.');
    }

    /* ═══════════════════════════════════════════════════════════════════
     *  USAGE REPORTS
     * ═════════════════════════════════════════════════════════════════ */

    public function usageReports(Request $request)
    {
        $query = EquipmentUsageReport::with([
            'trainingSession.branch',
            'inhouseTraining.branch',
            'reportedBy',
            'equipmentRequest',
        ]);

        if ($request->filled('training_type')) {
            if ($request->training_type === 'session') $query->whereNotNull('training_session_id');
            if ($request->training_type === 'inhouse') $query->whereNotNull('inhouse_training_id');
        }

        $reports = $query->latest()->paginate(20);

        return view('admin.equipment.usage-reports', compact('reports'));
    }

    public function createUsageReport(TrainingEquipmentRequest $equipmentRequest)
    {
        $equipmentRequest->load(['trainingSession', 'inhouseTraining', 'usageReport']);

        if ($equipmentRequest->usageReport) {
            return redirect()->route('admin.equipment.usage-reports')
                ->with('info', 'A usage report already exists for this request.');
        }

        return view('admin.equipment.create-usage-report', compact('equipmentRequest'));
    }

    public function storeUsageReport(Request $request, TrainingEquipmentRequest $equipmentRequest)
    {
        $validated = $request->validate([
            'quantity_used'              => 'required|integer|min:0',
            'quantity_returned'          => 'required|integer|min:0',
            'quantity_damaged'           => 'required|integer|min:0',
            'quantity_lost'              => 'required|integer|min:0',
            'equipment_condition_after'  => 'required|in:excellent,good,fair,poor,damaged',
            'usage_summary'              => 'nullable|string|max:1000',
            'issues_encountered'         => 'nullable|string|max:1000',
            'recommendations'            => 'nullable|string|max:1000',
        ]);

        EquipmentUsageReport::create(array_merge($validated, [
            'training_equipment_request_id' => $equipmentRequest->id,
            'training_session_id'           => $equipmentRequest->training_session_id,
            'inhouse_training_id'           => $equipmentRequest->inhouse_training_id,
            'equipment_type'                => $equipmentRequest->equipment_type,
            'equipment_id'                  => $equipmentRequest->equipment_id,
            'reported_by'                   => Auth::id(),
            'reported_at'                   => now(),
        ]));

        // Return equipment to inventory
        $equipment = $this->findEquipment($equipmentRequest->equipment_type, $equipmentRequest->equipment_id);
        if ($equipment) {
            $returned = $validated['quantity_returned'];
            $damaged  = $validated['quantity_damaged'];
            $newAvail = $equipment->available_quantity + $returned;
            $newQty   = $equipment->quantity - $damaged - $validated['quantity_lost'];
            $newStatus = $newAvail > 0 ? 'available' : $equipment->status;
            $newCondition = $validated['equipment_condition_after'];
            $equipment->update([
                'available_quantity' => max(0, $newAvail),
                'quantity'           => max(0, $newQty),
                'status'             => $newStatus,
                'condition'          => $newCondition,
            ]);
        }

        $equipmentRequest->update(['status' => 'returned']);

        return redirect()->route('admin.equipment.usage-reports')
            ->with('success', 'Usage report submitted and inventory updated.');
    }

    public function showUsageReport(EquipmentUsageReport $report)
    {
        $report->load(['trainingSession.branch', 'inhouseTraining.branch', 'reportedBy', 'equipmentRequest']);
        return view('admin.equipment.show-usage-report', compact('report'));
    }

    /* ═══════════════════════════════════════════════════════════════════
     *  TRAINING SCHEDULE EQUIPMENT VIEW
     * ═════════════════════════════════════════════════════════════════ */

    public function trainingEquipment(Request $request)
    {
        $sessions = TrainingSession::with([
            'branch', 'group', 'coach',
            'equipmentRequests.usageReport',
        ])->orderByDesc('date')->paginate(15, ['*'], 'sessions_page');

        $inhouse = InhouseTraining::with([
            'branch',
            'equipmentRequests.usageReport',
        ])->orderByDesc('training_date')->paginate(15, ['*'], 'inhouse_page');

        return view('admin.equipment.training-equipment', compact('sessions', 'inhouse'));
    }

    /* ═══════════════════════════════════════════════════════════════════
     *  PRIVATE HELPERS
     * ═════════════════════════════════════════════════════════════════ */

    private function getAllEquipmentList(): array
    {
        return [
            'general' => Equipment::select('id', 'name', 'available_quantity', 'status')->orderBy('name')->get(),
            'sports'  => SportsEquipment::select('id', 'name', 'available_quantity', 'status')->orderBy('name')->get(),
            'office'  => OfficeEquipment::select('id', 'name', 'available_quantity', 'status')->orderBy('name')->get(),
        ];
    }

    private function findEquipment(string $type, int $id): ?object
    {
        return match ($type) {
            'sports'  => SportsEquipment::find($id),
            'office'  => OfficeEquipment::find($id),
            default   => Equipment::find($id),
        };
    }
}
