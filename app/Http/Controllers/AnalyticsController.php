<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use App\Models\Electricity;
use App\DataTables\AnalyticsDataTable;
use App\DataTables\MonthlyDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class AnalyticsController extends Controller
{
    public function index(AnalyticsDataTable $dataTable)
    {
        // $model = DB::table('electricity')
        //         ->join('tenants', 'tenants.id', '=', 'electricity.tenant_id')
        //         ->select('electricity.amount_due', 'tenants.name', 'electricity.status')
        //         ->where('name', 'dsa')
        //         ->where('status', 'UNPAID')
        //         ->get();

        //         foreach($model AS $data) {
        //             echo $data->name;
        //             echo "<br>";
        //         }

        return $dataTable->render('analytics.index');
}
    public function create() {
        return View::make('apartment.create');
    }

    public function dashboard(MonthlyDataTable $dataTable) {
        return $dataTable->render('dashboard');
    }

    //     // Calculate overall due and update paid status
    //     foreach ($analyticsData as $data) {
    //         $data->calculateOverallDue();
    //     }

    //     return $dataTable->render('analytics.index', compact('analyticsData'));
    // }
}


