<?php

namespace App\DataTables;

use App\Models\Water;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WaterDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($water) {
                $action = "<span class='d-flex'>";
                if ($water->trashed()) {
                    $action .= "<a href='". url('water/'. $water->id.'/restore') ."' class='btn btn-success'><i class='fas fa-undo'></i></a>";
                } else {
                    $action .= "<a href='". url('water/'. $water->id .'/edit') ."' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                    $action .= "<a href='". url('water/'. $water->id.'/delete') ."' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
                }
                $action .= "</span>";
                return $action;
            })
            ->editColumn('tenant_id', function ($water) {
                return $water->tenant->name;
            })
            ->setRowId('id')
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Water $model): QueryBuilder
    {
        return $model->newQuery()->withTrashed();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('water-table')
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
            Column::make('tenant_id')->title('Tenant Name'),
            Column::make('date'),
            Column::make('total_head'),
            Column::make('amount_per_head'),
            Column::make('amount_due'),
            Column::make('deleted_at'),
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
        return 'Water_' . date('YmdHis');
    }
}
