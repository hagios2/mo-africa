<?php

namespace App\DataTables;

use App\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;


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
            ->addColumn('code', function ($query){
                return $query->code;
            })
            ->addColumn('phone', function ($query){
                return $query->phone;
            })
            ->addColumn('email', function ($query){
                return $query->email;
            })
            ->addColumn('created_at', function($query){
                return Carbon::parse($query->created_at)->format('D, d F Y');
            })
            ->addColumn('action', function($query){

                return '<div class="btn-group">'.
                    '<a title="View Reason For Joining" data-toggle="modal" data-target="#modal-default"  href="javascipt:void(0)" class="user_reason badge badge-info" style="font-size: 11px;"><span title="'.$query->id.'" class="div_id"></span><i class="fa fa-eye"></i></a>&emsp;'.
                    '<a title="Delete User" onclick="return confirm(\'Are you sure you want delete this user?\')" href="'.route('user.delete', $query->id).'"class="badge badge-danger" style="font-size: 11px;"><i class="fa fa-biohazard"></i></a>'.
                    '</div>

                        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Reason For Joining</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                       <p id="reasons_div" class="">

                            '.$query->reason.'
                        </p>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
';
            });
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
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('code'),
            Column::make('name'),
            Column::make('age'),
            Column::make('phone'),
            Column::make('email'),
            Column::make('profession'),
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
