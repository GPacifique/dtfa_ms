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
        ]);
    }
}
