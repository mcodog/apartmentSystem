<?php

namespace App\DataTables;

use App\Models\Tenant;
use App\Models\Billing;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class MonthlyDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($tenant) {
                $action = "<span class='d-flex flex-direction column'>";
                $action .= "<a href='". url('monthly/'. $tenant->id .'/edit') ."' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $action .= "<a href='". url('monthly/'. $tenant->id.'/delete') ."' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
                $action .= "</span>";

                return $action;
            })
            ->addColumn('January', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-02-01')
                ->where('date_paid', '>', '2023-12-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-02-01')
                ->where('date_paid', '>', '2023-12-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-02-01')
                ->where('date_paid', '>', '2023-12-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('February', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-03-01')
                ->where('date_paid', '>', '2024-01-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-03-01')
                ->where('date_paid', '>', '2024-01-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-03-01')
                ->where('date_paid', '>', '2024-01-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('March', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-04-01')
                ->where('date_paid', '>', '2024-02-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-04-01')
                ->where('date_paid', '>', '2024-02-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-04-01')
                ->where('date_paid', '>', '2024-02-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('April', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-05-01')
                ->where('date_paid', '>', '2024-03-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-05-01')
                ->where('date_paid', '>', '2024-03-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-05-01')
                ->where('date_paid', '>', '2024-03-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('May', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-06-01')
                ->where('date_paid', '>', '2024-04-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-06-01')
                ->where('date_paid', '>', '2024-04-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-06-01')
                ->where('date_paid', '>', '2024-04-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('June', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-07-01')
                ->where('date_paid', '>', '2024-05-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-07-01')
                ->where('date_paid', '>', '2024-05-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-07-01')
                ->where('date_paid', '>', '2024-05-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('July', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-08-01')
                ->where('date_paid', '>', '2024-06-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-08-01')
                ->where('date_paid', '>', '2024-06-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-08-01')
                ->where('date_paid', '>', '2024-06-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('August', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-09-01')
                ->where('date_paid', '>', '2024-07-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-09-01')
                ->where('date_paid', '>', '2024-07-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-09-01')
                ->where('date_paid', '>', '2024-07-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('September', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-10-01')
                ->where('date_paid', '>', '2024-08-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-10-01')
                ->where('date_paid', '>', '2024-08-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-10-01')
                ->where('date_paid', '>', '2024-08-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('October', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-11-01')
                ->where('date_paid', '>', '2024-09-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-11-01')
                ->where('date_paid', '>', '2024-09-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-11-01')
                ->where('date_paid', '>', '2024-09-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('November', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-12-01')
                ->where('date_paid', '>', '2024-10-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-12-01')
                ->where('date_paid', '>', '2024-10-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2024-12-01')
                ->where('date_paid', '>', '2024-10-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->addColumn('December', function ($tenant) {

                $electricity = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2025-01-01')
                ->where('date_paid', '>', '2024-11-31')
                ->whereNotNull('electricity_id')
                ->get();

                $elec_data = "Null";
                $desc_elec = "";
                $date_elec = "";
                foreach($electricity AS $data_electricity) {
                    $elec_data = $data_electricity->amt;
                    $desc_elec = $data_electricity->description;
                    $date_elec = $data_electricity->date_paid;
                }

                $water = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2025-01-01')
                ->where('date_paid', '>', '2024-11-31')
                ->whereNotNull('water_id')
                ->get();

                $water_data = "Null";
                $desc_water = "";
                $date_water = "";
                foreach($water AS $data_water) {
                    $water_data = $data_water->amt;
                    $desc_water = $data_water->description;
                    $date_water = $data_water->date_paid;
                }

                $apartment = DB::table('billing')
                ->join('tenants', 'tenants.id', '=', 'billing.tenant_id')
                ->select('billing.full_amount AS amt', 'tenants.name', 'billing.tenant_id', 'billing.date_paid', 'billing.description')
                ->where('name', $tenant->name)
                ->where('date_paid', '<', '2025-01-01')
                ->where('date_paid', '>', '2024-11-31')
                ->whereNotNull('apartment_id')
                ->get();

                $ap_data = "Null";
                $desc_ap = "";
                $date_ap = "";
                foreach($apartment AS $data_ap) {
                    $ap_data = $data_ap->amt;
                    $desc_ap = $data_ap->description;
                    $date_ap = $data_ap->date_paid;
                }


                $action = "<div class='card' style='width: 9rem;font-size: 10px;'>";
                $action .= "<ul class='list-group list-group-flush'>";
                $action .= "<li class='list-group-item'>". $elec_data ." (". $desc_elec ." at ". $date_elec .")</li>";
                $action .= "<li class='list-group-item'>". $water_data ." (". $desc_water ." at ". $date_water .")</li>";
                $action .= "<li class='list-group-item'>". $ap_data ." (". $desc_ap ." at ". $date_ap .")</li>";
                $action .= "</ul>";
                $action .= "</div>";

                return $action;
            })
            ->setRowId('id')
            ->rawColumns(['action', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Tenant $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('monthly-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name'),
            Column::make('January'),
            Column::make('February'),
            Column::make('March'),
            Column::make('April'),
            Column::make('May'),
            Column::make('June'),
            Column::make('July'),
            Column::make('August'),
            Column::make('September'),
            Column::make('October'),
            Column::make('November'),
            Column::make('December'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Monthly_' . date('YmdHis');
    }
}
