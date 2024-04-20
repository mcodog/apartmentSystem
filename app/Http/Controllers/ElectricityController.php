<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ElectricityDataTable; // Import the ElectricityDataTable class
use App\Models\Electricity; // Import the Electricity model
use App\Models\Tenant; // Import the Tenant model
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ElectricityController extends Controller
{
    public function index(ElectricityDataTable $dataTable)
    {
        return $dataTable->render('electricity.index');
    }

    public function create()
    {
        // Fetch all tenants to populate a dropdown or autocomplete field
        $tenants = Tenant::all();
        return view('electricity.create', compact('tenants'));
    }

    public function store(Request $request)
    {
        $electricity = new Electricity();
        $electricity->date = $request->date;
        $electricity->kwh = $request->kwh;
        $electricity->amount_per_kwh = $request->amount_per_kwh;
        $electricity->amount_due = $request->kwh * $request->amount_per_kwh; // Calculate total due

        // Find the tenant by its id
        $tenant = Tenant::findOrFail($request->tenant_id);

        // Assign tenant name to electricity record
        $electricity->tenant_id = $tenant->id;

        // Save the electricity record
        $electricity->save();

        return redirect()->route('electricity.index');
    }

    public function edit($id)
    {
        // Find the electricity record by its id
        $electricity = Electricity::findOrFail($id);

        // Fetch all tenants to populate a dropdown or autocomplete field
        $tenants = Tenant::all();

        // Pass the electricity and tenants data to the view
        return view('electricity.edit', compact('electricity', 'tenants'));
    }

    public function update(Request $request, $id)
    {
        $electricity = Electricity::findOrFail($id);
        $electricity->date = $request->date;
        $electricity->kwh = $request->kwh;
        $electricity->amount_per_kwh = $request->amount_per_kwh;
        $electricity->amount_due = $request->kwh * $request->amount_per_kwh; // Calculate total due

        // Find the tenant by its id
        $tenant = Tenant::findOrFail($request->tenant_id);

        // Assign tenant name to electricity record
        $electricity->tenant_id = $tenant->id;

        // Save the electricity record
        $electricity->save();

        return redirect()->route('electricity.index');
    }

    public function delete($id)
    {
        // Find the electricity record by its id
        $electricity = Electricity::findOrFail($id);

        // Delete the electricity record (soft delete)
        $electricity->delete();

        // Redirect to the index page or wherever appropriate
        return Redirect::to('electricity');
    }

    public function restore($id)
    {
        // Find the soft deleted electricity record by its id
        $electricity = Electricity::withTrashed()->findOrFail($id);

        // Restore the soft deleted electricity record
        $electricity->restore();

        // Redirect to the index page or wherever appropriate
        return redirect()->back()->with('success', 'Electricity record restored successfully.');
    }
}

