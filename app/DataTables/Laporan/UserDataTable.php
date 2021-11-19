<?php

namespace App\DataTables\Laporan;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\Role;
use App\mEnrollUjian;
use Auth;

class UserDataTable extends DataTable
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
        ->addColumn('edit', function($request){
            if($request->role_id == 2 || $request->id == Auth::user()->id){  
                return view ('datatable._edit',[
                    'model'    => $request,
                    'edit_url' => route('user.edit', $request->id)
                ]);
            }
            else{
            NULL;
            }                  
        })

        ->addColumn('delete', function($request){  
            if($request->role_id == 2 && mEnrollUjian::where('user_id', $request->id)->count() == 0){  
                return view ('datatable._delete',[
                    'model'    => $request,
                    'delete_url' => route('user.destroy', $request->id),
                    'confirm_message' => 'Yakin ingin menghapus User ' . $request->email . '?'
                ]);
            }
            else{
                NULL;
            }                 
        })

        ->addColumn('foto', function ($request) {
            if($request->image != NULL ){
                $url=asset("/storage/".$request->image); 
                return '<img src="'.$url.'" border="0" width="150" class="img-rounded" align="center" />';
            }
            else{
                return '<span class="label bg-red">Tidak Ada</span>';
            }
        })

        ->rawColumns(['edit','delete','foto']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = User::with('useremail','role')->where('status_akun', 2)->select('users.*');

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
            (['data'=> 'role.display_name' ,'name' => 'role.display_name' , 'title' => 'User Role']),
            (['data'=> 'edit' ,'name' => 'edit' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            (['data'=> 'delete' ,'name' => 'delete' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
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
        return 'Laporan/User_' . date('YmdHis');
    }
}
