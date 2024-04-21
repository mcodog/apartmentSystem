<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Apartment;
use Illuminate\Support\Facades\View;
use App\DataTables\ApartmentDataTable;
use DateTime;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ApartmentDataTable $dataTable)
    {
        return $dataTable->render('apartment.index');
        //aa
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenants = Tenant::all();
        return View::make('apartment.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'tenant_id' => 'required|exists:tenants,id', // Ensure the tenant ID exists in the tenants table
            'description' => 'required|string|max:255', // Description is required and should be a string
            'rental_fee' => 'required|numeric|min:0', // Rental fee should be a positive number
            'date_occupied' => 'required|date', // Date occupied should be a valid date
            'last_payment' => 'required|date', // Date occupied should be a valid date
        ]);

        // Create a new instance of the Apartment model
        $apartment = new Apartment();

        // Assign the validated request data to the model
        $apartment->tenant_id = $request->input('tenant_id');
        $apartment->description = $request->input('description');
        $apartment->rental_fee = $request->input('rental_fee');
        $apartment->date_occupied = $request->input('date_occupied');
        $apartment->last_payment = $request->input('last_payment');

        // Save the model to the database
        $apartment->save();

        // Redirect to a different page or respond with a success message
        // For example, redirecting to the apartment index page
        return redirect()->route('apartment.index')->with('success', 'Apartment record created successfully!');
    }

    public function fullpay($id) {
        $datetime2 = new DateTime();
        $electricity = Apartment::findOrFail($id);
        $electricity->last_payment = $datetime2;

        $electricity->save();

        return redirect()->route('apartment.index');
    }

    public function onepay($id){
        $electricity = Apartment::findOrFail($id);
        // Convert $electricity->last_payment to a DateTime object
        $lastPaymentDate = new \DateTime($electricity->last_payment);

        // Add 30 days to the date
        $lastPaymentDate->modify('+31 days');

        // Update the $electricity->last_payment property with the new date
        $electricity->last_payment = $lastPaymentDate->format('Y-m-d');

        $electricity->save();

        return redirect()->route('apartment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
