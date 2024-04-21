<?php

namespace App\Http\Controllers;

use App\DataTables\BillingDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Tenant;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BillingDataTable $dataTable)
    {
        
        return $dataTable->render('billing.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenants = Tenant::all();
        return View::make('billing.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
