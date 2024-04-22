<?php

namespace App\DataTables;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeInterface;

class ApartmentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'apartment.action')
            ->addColumn('Payment', function ($electricity) {
                    return "<a href='". url('apartment/'. $electricity->id.'/fullpay') ."' class='btn btn-primary my-1'>Settle Payment</a>". " " ."<a href='". url('apartment/'. $electricity->id.'/onepay') ."' class='btn btn-secondary'>Pay for 1 Month</a>";
            })
            ->addColumn('Elapsed Days Since Last Payment', function ($electricity) {
                $model = DB::table('apartment')
                ->join('tenants', 'tenants.id', '=', 'apartment.tenant_id')
                ->select('apartment.rental_fee AS amt', 'tenants.name', 'apartment.description', 'apartment.date_occupied', 'apartment.last_payment AS amt2')
                ->where('tenants.id', $electricity->tenant_id)
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
                    $result = "$months month" . ($months !== 1 ? 's' : '') . " and $days day" . ($days !== 1 ? 's' : '') ." || Rent amounts to: P" . $months * $temp->amt;
                    return $result;
                }
            })

            ->setRowId('id')
            ->rawColumns(['action', 'Payment', 'Elapsed Days Since Last Payment']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Apartment $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('apartment-table')
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
            
            Column::make('id'),
            Column::make('description'),
            Column::make('rental_fee'),
            Column::make('tenant_id'),
            Column::make('date_occupied'),
            Column::make('Elapsed Days Since Last Payment'),
            Column::make('last_payment'),
            Column::make('Payment'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Apartment_' . date('YmdHis');
    }
}
