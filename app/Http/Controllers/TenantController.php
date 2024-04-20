<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\TenantDataTable;
use App\Models\Tenant;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class TenantController extends Controller
{
    public function index(TenantDataTable $dataTable) {
        return $dataTable->render('tenant.index');
    }

    public function create() {
        return View::make('tenant.create');
    }

    public function store(Request $request) {
        $newTenant = new Tenant();
        $newTenant->name = $request->name;
        $newTenant->phone_number = $request->phone;
        $newTenant->emergency_contact_name = $request->emergency_contact_name;
        $newTenant->emergency_contact_number = $request->emergency_contact_number;
        if ($request->has('image')) {
            $newTenant->image = $request->file('image')->store('tenant', 'public');
        }
        $newTenant->save();

        return Redirect::to('tenants');
    }

    public function edit($id) {
        $tenant = Tenant::findOrFail($id);
        return View::make('tenant.edit', compact('tenant'));
    }

    public function update(Request $request, $id) {
        $tenant = Tenant::findOrFail($id);
        $tenant->name = $request->name;
        $tenant->phone_number = $request->phone;
        $tenant->emergency_contact_name = $request->emergency_contact_name;
        $tenant->emergency_contact_number = $request->emergency_contact_number;
        $tenant->save();

        return Redirect::to('tenants');
    }

    public function delete($id) {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete(); // Soft delete
        return Redirect::to('tenants');
    }

    public function restore($id)
    {
        // Find the soft deleted record by its id
        $tenant = Tenant::withTrashed()->findOrFail($id);

        // Restore the soft deleted record
        $tenant->restore();

        // Redirect back to the tenants page or wherever appropriate
        return redirect()->back()->with('success', 'Tenant restored successfully.');
    }

}
