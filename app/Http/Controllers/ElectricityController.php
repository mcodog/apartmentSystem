<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ElectricityDataTable; // Import the ElectricityDataTable class
use App\Models\Electricity; // Import the Electricity model
use App\Models\Billing; // Import the Electricity model
use App\Models\Tenant; // Import the Tenant model
use Illuminate\Support\Facades\Redirect;
use DateTime;
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

    public function altStatus($id) {
        $electricity = Electricity::findOrFail($id);
        if ($electricity->status == 'UNPAID'){
            $electricity->status = 'PAID';
            $column = 'electricity_id';
            $value = $id;

            $record = Billing::where($column, $value)->first();

            if ($record) {
                $dateToday = New DateTime();
                $record->description = "Pay Electric Bill";
                $record->date_paid = $dateToday;
                $record->full_amount = $electricity->amount_due;
                $record->save();
            } else {
                $dateToday = New DateTime();
                $newBilling = new Billing();
                $newBilling->description = "Pay Electric Bill";
                $newBilling->tenant_id = $electricity->tenant_id;
                $newBilling->full_amount = $electricity->amount_due;
                $newBilling->date_paid = $dateToday;
                $newBilling->electricity_id = $electricity->id;
                $newBilling->save();
            }
        } else if ($electricity->status == 'PAID'){
            $electricity->status = 'UNPAID';
            $column = 'electricity_id';
            $value = $id;

            $record = Billing::where($column, $value)->first();

            if ($record) {
                $dateToday = New DateTime();
                $record->description = "Revoke Electricity Bill Payment";
                $record->date_paid = $dateToday;
                $record->full_amount = $electricity->amount_due;
                $record->save();
            } else {
                $dateToday = New DateTime();
                $newBilling = new Billing();
                $newBilling->description = "Revoke Electricity Bill Payment";
                $newBilling->tenant_id = $electricity->tenant_id;
                $newBilling->full_amount = $electricity->amount_due;
                $newBilling->date_paid = $dateToday;
                $newBilling->electricity_id = $electricity->id;
                $newBilling->save();
            }
        }
        $electricity->save();
        return redirect()->route('electricity.index');
    }
}

