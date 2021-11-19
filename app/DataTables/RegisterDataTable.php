<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\mRegister;

class RegisterDataTable extends DataTable
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
        ->addColumn('accept', function($request){
                return view ('datatable._accept',[
                    'model'    => $request,
                   // 'method' => 'post',
                    'accept_url' => route('registered.store', $request->id),
                    'confirm_message' => 'Yakin ingin menerima User ?'
                ]);      
        })

        ->rawColumns(['accept']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = User::with('useremail','role')->where('status_akun', 1)->select('users.*');

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
                    ->parameters([
                        'buttons' => [
                            ['extend' => 'pdf', 'text' => 'Buat PDF'],
                            ['extend' => 'print', 'text' => 'Cetak Tabel']],
                        'dom' => '<"row"<"col-sm-4"l><"col-sm-5"B><"col-sm-3"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',  
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            (['data'=> 'id' ,'name' => 'id' , 'title' => 'ID',]),
            //(['data'=> 'foto' ,'name' => 'foto' , 'title' => 'Foto' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            (['data'=> 'nama' ,'name' => 'nama' , 'title' => 'Nama',]),
            (['data'=> 'email' ,'name' => 'email' , 'title' => 'Email']),
            //(['data'=> 'role.display_name' ,'name' => 'role.display_name' , 'title' => 'User Role']),
            //(['data'=> 'edit' ,'name' => 'edit' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            (['data'=> 'accept' ,'name' => 'accept' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            //(['data'=> 'intro' ,'name' => 'intro' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px'])
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Register_' . date('YmdHis');
    }
}
