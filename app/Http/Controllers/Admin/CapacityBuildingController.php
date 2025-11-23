<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CapacityBuilding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CapacityBuildingController extends Controller
{
    public function index()
    {
        $items = CapacityBuilding::latest()->paginate(20);
        return view('admin.capacity_buildings.index', compact('items'));
    }

    public function create()
    {
        return view('admin.capacity_buildings.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        CapacityBuilding::create($data);
        return redirect()->route('admin.capacity-buildings.index')->with('status', 'Capacity building record created');
    }

    public function show(CapacityBuilding $capacity_building)
    {
        return view('admin.capacity_buildings.show', ['item' => $capacity_building]);
    }

    public function edit(CapacityBuilding $capacity_building)
    {
        return view('admin.capacity_buildings.edit', ['item' => $capacity_building]);
    }

    public function update(Request $request, CapacityBuilding $capacity_building)
    {
        $data = $this->validateRequest($request);
        $capacity_building->update($data);
        return redirect()->route('admin.capacity-buildings.index')->with('status', 'Capacity building record updated');
    }

    public function destroy(CapacityBuilding $capacity_building)
    {
        $capacity_building->delete();
        return redirect()->route('admin.capacity-buildings.index')->with('status', 'Record deleted');
    }

    /**
     * Display summary statistics for capacity building costs.
     */
    public function stats()
    {
        $query = CapacityBuilding::query();

        $count = (int) $query->count();
        $total = (float) CapacityBuilding::sum('cost_amount');
        $average = $count ? (float) CapacityBuilding::avg('cost_amount') : 0.0;
        $min = CapacityBuilding::min('cost_amount');
        $max = CapacityBuilding::max('cost_amount');

        $byCostType = CapacityBuilding::selectRaw('cost_type, COUNT(*) as count, SUM(cost_amount) as total')
            ->groupBy('cost_type')
            ->get()
            ->map(function ($row) {
                return [
                    'cost_type' => $row->cost_type,
                    'count' => (int) $row->count,
                    'total' => (float) $row->total,
                ];
            });

        $byCategory = CapacityBuilding::selectRaw('training_category, COUNT(*) as count, SUM(cost_amount) as total')
            ->groupBy('training_category')
            ->orderByDesc('total')
            ->get();

        // Breakdown by branch
        $byBranch = CapacityBuilding::selectRaw('branch, COUNT(*) as count, SUM(cost_amount) as total')
            ->groupBy('branch')
            ->orderByDesc('total')
            ->get();

        // Time series by month (YYYY-MM)
        $byMonth = CapacityBuilding::selectRaw("DATE_FORMAT(start_date, '%Y-%m') as month, COUNT(*) as count, SUM(cost_amount) as total")
            ->whereNotNull('start_date')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Time series by quarter (e.g., 2025 Q1)
        $byQuarter = CapacityBuilding::selectRaw("CONCAT(YEAR(start_date),' Q', QUARTER(start_date)) as quarter, COUNT(*) as count, SUM(cost_amount) as total")
            ->whereNotNull('start_date')
            ->groupBy('quarter')
            ->orderBy('quarter')
            ->get();

        return view('admin.capacity_buildings.stats', compact(
            'count','total','average','min','max','byCostType','byCategory','byBranch','byMonth','byQuarter'
        ));
    }

    /**
     * Export stats as CSV.
     */
    public function exportStats()
    {
        $filename = 'capacity_building_stats_' . date('Ymd_His') . '.csv';

        $callback = function () {
            $out = fopen('php://output', 'w');

            // Top-level summary
            fputcsv($out, ['Metric', 'Value']);
            fputcsv($out, ['Records', CapacityBuilding::count()]);
            fputcsv($out, ['Total Cost', CapacityBuilding::sum('cost_amount')]);
            fputcsv($out, ['Average Cost', CapacityBuilding::avg('cost_amount')]);
            fputcsv($out, ['Min Cost', CapacityBuilding::min('cost_amount')]);
            fputcsv($out, ['Max Cost', CapacityBuilding::max('cost_amount')]);
            fputcsv($out, []);

            // By cost type
            fputcsv($out, ['By Cost Type']);
            fputcsv($out, ['Cost Type', 'Count', 'Total']);
            $rows = CapacityBuilding::selectRaw('cost_type, COUNT(*) as count, SUM(cost_amount) as total')
                ->groupBy('cost_type')
                ->get();
            foreach ($rows as $r) {
                fputcsv($out, [$r->cost_type, $r->count, $r->total]);
            }
            fputcsv($out, []);

            // By branch
            fputcsv($out, ['By Branch']);
            fputcsv($out, ['Branch', 'Count', 'Total']);
            $branches = CapacityBuilding::selectRaw('branch, COUNT(*) as count, SUM(cost_amount) as total')
                ->groupBy('branch')
                ->get();
            foreach ($branches as $b) {
                fputcsv($out, [$b->branch, $b->count, $b->total]);
            }
            fputcsv($out, []);

            // By month
            fputcsv($out, ['By Month']);
            fputcsv($out, ['Month', 'Count', 'Total']);
            $months = CapacityBuilding::selectRaw("DATE_FORMAT(start_date, '%Y-%m') as month, COUNT(*) as count, SUM(cost_amount) as total")
                ->whereNotNull('start_date')
                ->groupBy('month')
                ->orderBy('month')
                ->get();
            foreach ($months as $m) {
                fputcsv($out, [$m->month, $m->count, $m->total]);
            }

            fclose($out);
        };

        return response()->streamDownload($callback, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'branch' => 'nullable|string|max:255',
            'role_function' => 'nullable|string|max:255',
            'training_name' => 'required|string|max:255',
            'institution_name' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'channel' => 'nullable|string|max:100',
            'cost_type' => 'nullable|string|in:free,paid',
            'cost_amount' => 'nullable|numeric|min:0',
            'training_category' => 'nullable|string|max:100',
            'venue' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);
    }
}
