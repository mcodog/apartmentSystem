<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ElectricityController;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BillingController;
use App\DataTables\MonthlyDataTable;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Redirect::to('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tenants', [TenantController::class, 'index'])->name('tenants');
Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
Route::post('/tenants/store', [TenantController::class, 'store'])->name('tenants.store');
Route::get('/tenants/{id}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
Route::post('/tenants/{id}/update', [TenantController::class, 'update'])->name('tenants.update');
Route::get('/tenants/{id}/delete', [TenantController::class, 'delete'])->name('tenants.delete');
Route::get('tenants/{id}/restore', [TenantController::class, 'restore'])->name('tenants.restore');
Route::get('/electricity', [ElectricityController::class, 'index'])->name('electricity.index');

// Route for displaying the form to create a new electricity record
Route::get('/electricity/create', [ElectricityController::class, 'create'])->name('electricity.create');

// Route for storing the newly created electricity record
Route::post('/electricity/store', [ElectricityController::class, 'store'])->name('electricity.store');

// Route for displaying the form to edit an existing electricity record
Route::get('/electricity/{id}/edit', [ElectricityController::class, 'edit'])->name('electricity.edit');

// Route for updating an existing electricity record
Route::get('/electricity/{id}/update', [ElectricityController::class, 'update'])->name('electricity.update');
Route::get('/electricity/{id}/altStat', [ElectricityController::class, 'altStatus'])->name('electricity.altStat');


// Route for deleting an existing electricity record
Route::get('/electricity/{id}/delete', [ElectricityController::class, 'delete'])->name('electricity.delete');

// Route for restoring a soft-deleted electricity record
Route::get('/electricity/{id}/restore', [ElectricityController::class, 'restore'])->name('electricity.restore');

// Route for displaying water records
Route::get('/water', [WaterController::class, 'index'])->name('water.index');
Route::get('/water/{id}/altStat', [WaterController::class, 'altStatus'])->name('water.altStat');

// Route for displaying the form to create a new water record
Route::get('/water/create', [WaterController::class, 'create'])->name('water.create');

// Route for storing the newly created water record
Route::post('/water/store', [WaterController::class, 'store'])->name('water.store');

// Route for displaying the form to edit an existing water record
Route::get('/water/{id}/edit', [WaterController::class, 'edit'])->name('water.edit');

// Route for updating an existing water record
Route::put('/water/{id}/update', [WaterController::class, 'update'])->name('water.update');

// Route for deleting an existing water record
Route::delete('/water/{id}/delete', [WaterController::class, 'delete'])->name('water.delete');

// Route for restoring a soft-deleted water record
Route::get('/water/{id}/restore', [WaterController::class, 'restore'])->name('water.restore');

Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

Route::get('/apartment', [ApartmentController::class, 'index'])->name('apartment.index');
Route::get('/apartment/create', [ApartmentController::class, 'create'])->name('apartment.create');
Route::post('/apartment/store', [ApartmentController::class, 'store'])->name('apartment.store');
Route::get('/apartment/{id}/fullpay', [ApartmentController::class, 'fullpay'])->name('apartment.fullpay');
Route::get('/apartment/{id}/onepay', [ApartmentController::class, 'onepay'])->name('apartment.onepay');

Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
Route::get('/billing/create', [BillingController::class, 'create'])->name('billing.create');
Route::get('/billing/store', [BillingController::class, 'store'])->name('billing.store');
Route::get('/dashboard', [AnalyticsController::class, 'dashboard'])->name('dashboard');
