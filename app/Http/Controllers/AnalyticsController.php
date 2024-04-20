<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use App\DataTables\AnalyticsDataTable;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AnalyticsController extends Controller
{
    public function index(AnalyticsDataTable $dataTable)
    {
        // $analyticsData = Analytics::with('tenant')
        //     ->leftJoin('electricity', 'analytics.tenant_id', '=', 'electricity.tenant_id')
        //     ->leftJoin('water', 'analytics.tenant_id', '=', 'water.tenant_id')
        //     ->select('analytics.tenant_id',
        //         DB::raw('COALESCE(SUM(electricity.amount_due), 0) as electricity_amount_due'),
        //         DB::raw('COALESCE(SUM(water.amount_due), 0) as water_amount_due'))
        //     ->groupBy('analytics.tenant_id')
        //     ->get();


        return $dataTable->render('analytics.index');
}

    //     // Calculate overall due and update paid status
    //     foreach ($analyticsData as $data) {
    //         $data->calculateOverallDue();
    //     }

    //     return $dataTable->render('analytics.index', compact('analyticsData'));
    // }
}


