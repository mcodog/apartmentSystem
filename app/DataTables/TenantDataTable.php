<?php

namespace App\DataTables;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TenantDataTable extends DataTable
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
                $action = "<span class='d-flex'>";

                // Check if the record is soft deleted
                if ($tenant->trashed()) {
                    // If soft deleted, add restore button
                    $action .= "<a href='". url('tenants/'. $tenant->id.'/restore') ."' class='btn btn-success'><i class='fas fa-undo'></i></a>";
                } else {
                    // If not soft deleted, add edit and delete buttons
                    $action .= "<a href='". url('tenants/'. $tenant->id .'/edit') ."' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                    $action .= "<a href='". url('tenants/'. $tenant->id.'/delete') ."' class='btn btn-danger'><i class='fas fa-trash'></i></a>";
                }

                $action .= "</span>";

                return $action;
            })
            ->addColumn('image', function ($tenant) {
                return "<img src='". url($tenant->getImage()) ."' alt='Tenant' style='width:50px;'>";
            })
            ->setRowId('id')
            ->rawColumns(['action', 'image']);
    }



    /**
     * Get the query source of dataTable.
     */
    public function query(Tenant $model): QueryBuilder
    {
        return $model->newQuery()->withTrashed();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tenant-table')
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
            Column::computed('image'),
            Column::make('name'),
            Column::make('emergency_contact_name'),
            Column::make('emergency_contact_number'),
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
        return 'Tenant_' . date('YmdHis');
    }
}
