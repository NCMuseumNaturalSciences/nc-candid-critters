<?php

namespace App\DataTables;

use App\Signups;
use Yajra\DataTables\Services\DataTable;

class SignupsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query);
        /* return datatables($query)
            ->addColumn('action', 'signups.action');
        */
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Signups $model)
    {
        return $model->newQuery()->select(
            'id',
                    'first_name',
                    'last_name',
                    'email',
                    'acf_uploader_yn',
                    'acf_borrower_yn',
                    'training_assigned_yn',
                    'volunteer_yn'
        );
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'order' => [1, 'asc'],
                        'select' => [
                            'style' => 'os',
                            'selector' => 'td:first-child',
                        ],
                        'buttons' => [
                            ['extend' => 'create', 'editor' => 'editor'],
                            ['extend' => 'edit', 'editor' => 'editor'],
                            ['extend' => 'remove', 'editor' => 'editor'],
                        ]
                    ]);
                    //->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data' => null,
                'defaultContent' => '',
                'className' => 'select-checkbox',
                'title' => '',
                'orderable' => false,
                'searchable' => false
            ],
            'id',
            'first_name',
            'last_name',
            'email',
            'acf_uploader_yn',
            'acf_borrower_yn',
            'training_assigned_yn',
            'volunteer_yn'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Signups_' . date('YmdHis');
    }
}
