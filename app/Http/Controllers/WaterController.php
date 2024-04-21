<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\WaterDataTable; // Import the WaterDataTable class
use App\Models\Water; // Import the Water model
use App\Models\Tenant; // Import the Tenant model
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class WaterController extends Controller
{
    public function index(WaterDataTable $dataTable)
    {
        return $dataTable->render('water.index');
    }

    public function create()
    {
        // Fetch all tenants to populate a dropdown or autocomplete field
        $tenants = Tenant::all();
        return view('water.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $water = new Water();
        $water->date = $request->date;
        $water->total_head = $request->total_head;
        $water->amount_per_head = $request->amount_per_head;
        $water->amount_due = $request->total_head * $request->amount_per_head; // Calculate total due

        // Find the tenant by its id
        $tenant = Tenant::findOrFail($request->tenant_id);

        // Assign tenant ID to water record
        $water->tenant_id = $tenant->id;

        // Save the water record
        $water->save();

        return redirect()->route('water.index');
    }

    public function edit($id)
    {
        // Find the water record by its id
        $water = Water::findOrFail($id);

        // Fetch all tenants to populate a dropdown or autocomplete field
        $tenants = Tenant::all();

        // Pass the water and tenants data to the view
        return view('water.edit', compact('water', 'tenants'));
    }

    public function update(Request $request, $id)
    {
        $water = Water::findOrFail($id);
        $water->date = $request->date;
        $water->total_head = $request->total_head;
        $water->amount_per_head = $request->amount_per_head;
        $water->amount_due = $request->total_head * $request->amount_per_head; // Calculate total due

        // Find the tenant by its id
        $tenant = Tenant::findOrFail($request->tenant_id);

        // Assign tenant ID to water record
        $water->tenant_id = $tenant->id;

        // Save the water record
        $water->save();

        return redirect()->route('water.index');
    }

    public function delete($id)
    {
        // Find the water record by its id
        $water = Water::findOrFail($id);

        // Delete the water record (soft delete)
        $water->delete();

        // Redirect to the index page or wherever appropriate
        return Redirect::to('water');
    }

    public function restore($id)
    {
        // Find the soft deleted water record by its id
        $water = Water::withTrashed()->findOrFail($id);

        // Restore the soft deleted water record
        $water->restore();

        // Redirect to the index page or wherever appropriate
        return redirect()->back()->with('success', 'Water record restored successfully.');
    }

    public function altStatus($id) {
        $electricity = Water::findOrFail($id);
        if ($electricity->status == 'UNPAID'){
            $electricity->status = 'PAID';
        } else if ($electricity->status == 'PAID'){
            $electricity->status = 'UNPAID';
        }
        $electricity->save();
        return redirect()->route('water.index');
    }
}
