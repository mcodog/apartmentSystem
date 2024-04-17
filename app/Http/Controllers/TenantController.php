<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\TenantDataTable;
use App\Models\Tenant;
use View;
use Illuminate\Support\Facades\Redirect;

class TenantController extends Controller
{
    public function index(TenantDataTable $dataTable) {
        return $dataTable->render('tenant.index');
    }

    public function create() {
        return View::make('tenant.create');
    }

    public function store(Request $request) {
        $newTenant = New Tenant();
        $newTenant->name = $request->name;
        $newTenant->phone_number = $request->phone;
        $newTenant->emergency_contact_name = $request->emergency_contact_name;
        $newTenant->emergency_contact_number = $request->emergency_contact_number;
        $newTenant->save();

        return Redirect::to('tenant/index');
    }
}
