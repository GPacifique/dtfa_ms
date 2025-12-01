<?php

namespace App\Http\Controllers;

use App\Models\SportsEquipment;
use App\Models\OfficeEquipment;
use Illuminate\Http\Request;

class KitManagerController extends Controller
{
    /**
     * Show the kit manager dashboard
     */
    public function dashboard()
    {
        // Sports Equipment Stats
        $sportsEquipmentTotal = SportsEquipment::count();
        $sportsEquipmentByCondition = SportsEquipment::select('condition')
            ->selectRaw('count(*) as count')
            ->groupBy('condition')
            ->get()
            ->pluck('count', 'condition');

        $sportsEquipmentByStatus = SportsEquipment::select('status')
            ->selectRaw('count(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        // Office Equipment Stats
        $officeEquipmentTotal = OfficeEquipment::count();
        $officeEquipmentByCondition = OfficeEquipment::select('condition')
            ->selectRaw('count(*) as count')
            ->groupBy('condition')
            ->get()
            ->pluck('count', 'condition');

        $officeEquipmentByStatus = OfficeEquipment::select('status')
            ->selectRaw('count(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        // Recent equipment changes
        $recentSportsEquipment = SportsEquipment::latest('updated_at')->limit(5)->get();
        $recentOfficeEquipment = OfficeEquipment::latest('updated_at')->limit(5)->get();

        // Equipment needing maintenance/repair
        $damageEquipment = SportsEquipment::where('condition', 'damaged')->count();
        $damageSportsEquipment = SportsEquipment::where('condition', 'damaged')->get();
        $damageOfficeEquipment = OfficeEquipment::where('condition', 'damaged')->get();

        // Sports equipment by type
        $equipmentTypes = SportsEquipment::select('equipment_type')
            ->selectRaw('count(*) as count')
            ->groupBy('equipment_type')
            ->orderByRaw('count DESC')
            ->get();

        // Additional detailed stats
        $sportsEquipmentInUse = SportsEquipment::where('status', 'in use')->count();
        $sportsEquipmentStored = SportsEquipment::where('status', 'stored')->count();
        $sportsEquipmentInGoodCondition = SportsEquipment::where('condition', 'excellent')->orWhere('condition', 'good')->count();

        $officeEquipmentInUse = OfficeEquipment::where('status', 'in use')->count();
        $officeEquipmentStored = OfficeEquipment::where('status', 'stored')->count();
        $officeEquipmentAssigned = OfficeEquipment::whereNotNull('assigned_to')->count();

        // Count equipment with warranty expiring soon (within 30 days)
        $warrantyExpiringCount = OfficeEquipment::whereNotNull('warranty_expiry')
            ->whereDate('warranty_expiry', '<=', now()->addDays(30))
            ->count();

        // Equipment utilization rate (percentage of sports equipment in use)
        $sportsEquipmentUtilizationRate = $sportsEquipmentTotal > 0
            ? round(($sportsEquipmentInUse / $sportsEquipmentTotal) * 100, 1)
            : 0;

        return view('kit-manager.dashboard', [
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
