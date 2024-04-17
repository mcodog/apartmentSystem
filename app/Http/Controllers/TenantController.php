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
        if(request()->has('image')){
            // $imagePath = request()->file('image')->store('category', 'public');
            $newTenant->image = request()->file('image')->store('tenant', 'public');;
        }
        $newTenant->save();

        return Redirect::to('tenants');
    }

    public function edit($id) {
        $tenant = Tenant::find($id);
        return View::make('tenant.edit', compact('tenant'));
    }

    public function update(Request $request, $id) {
        $tenant = Tenant::find($id);
        $tenant->name = $request->name;
        $tenant->phone_number = $request->phone;
        $tenant->emergency_contact_name = $request->emergency_contact_name;
        $tenant->emergency_contact_number = $request->emergency_contact_number;
        $tenant->save();

        return Redirect::to('tenants');
    }

    public function delete($id) {
        Tenant::destroy($id);
        return Redirect::to('tenants');
    }
}
