<?php

namespace App\DataTables;

use App\Models\Analytic;
use App\Models\Electricity;
use App\Models\Tenant;
use DateTime;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
// use App\Models\Tenant;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Converter\TimeConverterInterface;

class AnalyticsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'analytics.action')
            ->addColumn('Electricity Bill', function ($electricity) {
                $model = DB::table('electricity')
                ->join('tenants', 'tenants.id', '=', 'electricity.tenant_id')
                ->select('electricity.amount_due AS amt', 'tenants.name', 'electricity.status', 'electricity.tenant_id')
                ->where('name', $electricity->name)
                ->where('status', 'UNPAID')
                ->get();

                $num = 0;
                foreach($model AS $data) {
                    $num = $num + $data->amt;
                }
                return $num;
            })
            ->addColumn('Water Bill', function ($electricity) {
                $model = DB::table('water')
                ->join('tenants', 'tenants.id', '=', 'water.tenant_id')
                ->selectRaw('SUM(water.amount_due) AS amt, tenants.name, water.status, water.tenant_id')
                ->where('tenants.name', $electricity->name) // Specify the tenant's name
                ->where('status', 'UNPAID')
                ->groupBy('tenants.name', 'water.tenant_id', 'water.status') // Group by the necessary columns
                ->get();


                $num = 0;
                foreach($model AS $data) {
                    $num = $num + $data->amt;
                }

                return $num;
            })
            ->addColumn('Elapsed Days Since Last Payment', function ($electricity) {
                $model = DB::table('apartment')
                ->join('tenants', 'tenants.id', '=', 'apartment.tenant_id')
                ->select('apartment.rental_fee AS amt', 'tenants.name', 'apartment.description', 'apartment.date_occupied', 'apartment.last_payment AS amt2')
                ->where('name', $electricity->name)
                ->get();


                if ($model->isEmpty()) {
                    // Return the string "null" if the collection is empty
                    return "Null";
                } else {
                    // Access the first record and return the value of amt2
                    $temp = $model[0];
                    $date1 = $temp->amt2;

                    $datetime1 = new DateTime($date1);
                    $datetime2 = new DateTime();


                    $interval = $datetime1->diff($datetime2);
                    $daysDifference = $interval->days;
                    $months = intdiv($daysDifference, 30);
                    $days = $daysDifference % 30;
                    if($months > 1) {
                        $payment_due = $months * $temp->amt;
                        for($i = 1; $i < $months; $i++) {
                            $payment_due = $payment_due + ($temp->amt * .10);
                        }
                    } else {
                        $payment_due = $months * $temp->amt;
                    }
                    $result = "$months month" . ($months !== 1 ? 's' : '') . " and $days day" . ($days !== 1 ? 's' : '') ." || Rent amounts to: P" . $payment_due;
                    return $result;
                }

            })
            ->addColumn('overall_due', function ($electricity) {
                $model = DB::table('water')
                ->join('tenants', 'tenants.id', '=', 'water.tenant_id')
                ->select('water.amount_due AS amt', 'tenants.name', 'water.status', 'water.tenant_id')
                ->where('name', $electricity->name)
                ->where('status', 'UNPAID')
                ->get();

                $num = 0;
                foreach($model AS $data) {
                    $num = $num + $data->amt;
                }

                $model = DB::table('electricity')
                ->join('tenants', 'tenants.id', '=', 'electricity.tenant_id')
                ->select('electricity.amount_due AS amt', 'tenants.name', 'electricity.status', 'electricity.tenant_id')
                ->where('name', $electricity->name)
                ->where('status', 'UNPAID')
                ->get();

                $num2 = 0;
                foreach($model AS $data) {
                    $num2 = $num2 + $data->amt;
                }

                $num3 = 0;

                $model = DB::table('apartment')
                ->join('tenants', 'tenants.id', '=', 'apartment.tenant_id')
                ->select('apartment.rental_fee AS amt', 'tenants.name', 'apartment.description', 'apartment.date_occupied', 'apartment.last_payment AS amt2')
                ->where('name', $electricity->name)
                ->get();


                if ($model->isEmpty()) {
                    // Return the string "null" if the collection is empty
                    return "Null";
                } else {
                    // Access the first record and return the value of amt2
                    $temp = $model[0];
                    $date1 = $temp->amt2;

                    $datetime1 = new DateTime($date1);
                    $datetime2 = new DateTime();


                    $interval = $datetime1->diff($datetime2);
                    $daysDifference = $interval->days;
                    $months = intdiv($daysDifference, 30);
                    $days = $daysDifference % 30;
                    $result = "$months month" . ($months !== 1 ? 's' : '') . " and $days day" . ($days !== 1 ? 's' : '');
                    $num3 =  $months * $temp->amt;
                }

                return $num + $num2 + $num3;
            })
            ->setRowId('id', 'calculate_electricity', 'calculate_water', 'overall_due');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Tenant $model): QueryBuilder
    {
        // $model = Tenant::query()
        // ->leftJoin('electricity', 'tenants.id', '=', 'electricity.tenant_id')
        // ->leftJoin('water', 'tenants.id', '=', 'water.tenant_id')
        // ->select('electricity.amount_due as electricity_amount_due', 'water.amount_due as water_amount_due', 'tenants.id', 'tenants.name');


        // $newDatatable = DataTables::of($model->newQuery())->make(true);
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('analytics-table')
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
            Column::make('name')->title('Tenant Name'),
            Column::make('Electricity Bill'),
            Column::make('Water Bill'),
            Column::make('Elapsed Days Since Last Payment'),
            Column::make('overall_due'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Analytics_' . date('YmdHis');
    }
}
