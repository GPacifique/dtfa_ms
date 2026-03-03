<?php

namespace App\Http\Controllers;

use App\Models\SportsEquipment;
use App\Models\OfficeEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KitManagerController extends Controller
{
    /**
     * Show the kit manager dashboard
     */
    public function dashboard()
    {
        $user     = Auth::user();
        $isGlobal = $user->hasRole(['super-admin', 'CEO']);
        $branchId = $isGlobal ? null : (int) $user->branch_id;

        // Shorthand: apply optional branch scope
        $b = fn ($q) => $branchId ? $q->where('branch_id', $branchId) : $q;

        // Sports Equipment Stats
        $sportsEquipmentTotal = $b(SportsEquipment::query())->count();
        $sportsEquipmentByCondition = $b(SportsEquipment::select('condition')
            ->selectRaw('count(*) as count')
            ->groupBy('condition'))
            ->get()
            ->pluck('count', 'condition');

        $sportsEquipmentByStatus = $b(SportsEquipment::select('status')
            ->selectRaw('count(*) as count')
            ->groupBy('status'))
            ->get()
            ->pluck('count', 'status');

        // Office Equipment Stats
        $officeEquipmentTotal = $b(OfficeEquipment::query())->count();
        $officeEquipmentByCondition = $b(OfficeEquipment::select('condition')
            ->selectRaw('count(*) as count')
            ->groupBy('condition'))
            ->get()
            ->pluck('count', 'condition');

        $officeEquipmentByStatus = $b(OfficeEquipment::select('status')
            ->selectRaw('count(*) as count')
            ->groupBy('status'))
            ->get()
            ->pluck('count', 'status');

        // Recent equipment changes
        $recentSportsEquipment = $b(SportsEquipment::latest('updated_at'))->limit(5)->get();
        $recentOfficeEquipment = $b(OfficeEquipment::latest('updated_at'))->limit(5)->get();

        // Equipment needing maintenance/repair
        $damageEquipment      = $b(SportsEquipment::where('condition', 'damaged'))->count();
        $damageSportsEquipment = $b(SportsEquipment::where('condition', 'damaged'))->get();
        $damageOfficeEquipment = $b(OfficeEquipment::where('condition', 'damaged'))->get();

        // Sports equipment by type
        $equipmentTypes = $b(SportsEquipment::select('equipment_type')
            ->selectRaw('count(*) as count')
            ->groupBy('equipment_type')
            ->orderByRaw('count DESC'))
            ->get();

        // Additional detailed stats
        $sportsEquipmentInUse         = $b(SportsEquipment::where('status', 'in use'))->count();
        $sportsEquipmentStored        = $b(SportsEquipment::where('status', 'stored'))->count();
        $sportsEquipmentInGoodCondition = $b(SportsEquipment::where(fn ($q) => $q->where('condition', 'excellent')->orWhere('condition', 'good')))->count();

        $officeEquipmentInUse    = $b(OfficeEquipment::where('status', 'in use'))->count();
        $officeEquipmentStored   = $b(OfficeEquipment::where('status', 'stored'))->count();
        $officeEquipmentAssigned = $b(OfficeEquipment::whereNotNull('assigned_to'))->count();

        // Count equipment with warranty expiring soon (within 30 days)
        $warrantyExpiringCount = $b(OfficeEquipment::whereNotNull('warranty_expiry')
            ->whereDate('warranty_expiry', '<=', now()->addDays(30)))->count();

        // Equipment utilization rate (percentage of sports equipment in use)
        $sportsEquipmentUtilizationRate = $sportsEquipmentTotal > 0
            ? round(($sportsEquipmentInUse / $sportsEquipmentTotal) * 100, 1)
            : 0;

        return view('kit-manager.dashboard2', [
            'title' => 'Kit Manager Dashboard',
            'sportsEquipmentTotal' => $sportsEquipmentTotal,
            'officeEquipmentTotal' => $officeEquipmentTotal,
            'sportsEquipmentByCondition' => $sportsEquipmentByCondition,
            'sportsEquipmentByStatus' => $sportsEquipmentByStatus,
            'officeEquipmentByCondition' => $officeEquipmentByCondition,
            'officeEquipmentByStatus' => $officeEquipmentByStatus,
            'recentSportsEquipment' => $recentSportsEquipment,
            'recentOfficeEquipment' => $recentOfficeEquipment,
            'damageEquipment' => $damageEquipment,
            'damageSportsEquipment' => $damageSportsEquipment,
            'damageOfficeEquipment' => $damageOfficeEquipment,
            'equipmentTypes' => $equipmentTypes,
            'sportsEquipmentInUse' => $sportsEquipmentInUse,
            'sportsEquipmentStored' => $sportsEquipmentStored,
            'sportsEquipmentInGoodCondition' => $sportsEquipmentInGoodCondition,
            'officeEquipmentInUse' => $officeEquipmentInUse,
            'officeEquipmentStored' => $officeEquipmentStored,
            'officeEquipmentAssigned' => $officeEquipmentAssigned,
            'warrantyExpiringCount' => $warrantyExpiringCount,
            'sportsEquipmentUtilizationRate' => $sportsEquipmentUtilizationRate,
        ]);
    }
}
