<?php

namespace App\DataTables;

use App\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class UsersDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables($query)
            ->addColumn('name', function($query){
                return $query->name;
            })
            ->addColumn('age', function($query){
                return Carbon::parse($query->dob)->age;
            })
            ->addColumn('profession', function ($query){
                return $query->profession;
            })
            ->addColumn('reason', function ($query){
                return $query->reason;
            })
            ->addColumn('created_at', function($query){
                return Carbon::parse($query->created_at)->format('D, d F Y');
            })
            ->addColumn('action', function($query){

                return '<div class="btn-group">'.
                    '<a title="Delete User" href="'.route('user.delete', $query->id).'"class="badge badge-danger" style="font-size: 11px;"><i class="fa fa-remove"></i></a>'.
                    '</div>';
            });
//            ->rawColumns(['reason']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\UsersDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $query = User::query();

        return $this->applyScopes($query);
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
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('name'),
            Column::make('age'),
            Column::make('profession'),
            Column::make('reason')
                ->width(100),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}