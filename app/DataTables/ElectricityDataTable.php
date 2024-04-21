<?php

namespace App\DataTables;

use App\Models\Electricity;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ElectricityDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($electricity) {
                $action = "<span class='d-flex'>";

                // Check if the record is soft deleted
                if ($electricity->trashed()) {
                    // If soft deleted, add restore button
                    $action .= "<a href='". url('electricity/'. $electricity->id.'/restore') ."' class='btn btn-success'><i class='fas fa-undo'></i></a>";
                } else {
                    // If not soft deleted, add edit and delete buttons
                    $action .= "<a href='". url('electricity/'. $electricity->id .'/edit') ."' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                    $action .= "<a href='". url('electricity/'. $electricity->id.'/delete') ."' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
                }

                $action .= "</span>";

                return $action;
            })
            ->addColumn('Change_Status', function ($electricity) {
                if ($electricity->status == 'UNPAID') {
                    return "<a href=". url('/electricity/' . $electricity->id . '/altStat') ." class='btn btn-primary'>Set as Paid</a>";
                } else if ($electricity->status == 'PAID') {
                    return "<a href=" . url('/electricity/' . $electricity->id . '/altStat') ." class='btn btn-secondary'>Set as Unpaid</a>";
                }
            })
            ->editColumn('tenant_id', function ($electricity) {
                return $electricity->tenant->name;
            })
            ->setRowId('id')
            ->rawColumns(['action', 'Change_Status']);
    }
    /**
     * Get the query source of dataTable.
     */
    public function query(Electricity $model): QueryBuilder
    {
        return $model->newQuery()->withTrashed();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('electricity-table')
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
    protected function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('tenant_id')->title('Tenant Name'), // Change column name to 'Tenant Name'
            Column::make('date'),
            Column::make('kwh'),
            Column::make('amount_per_kwh'),
            Column::make('amount_due'),
            Column::make('status'),
            Column::make('deleted_at'),
            Column::make('Change_Status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Electricity_' . date('YmdHis');
    }
}
