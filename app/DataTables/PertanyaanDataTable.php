<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\mPertanyaan;
use Carbon;
use Auth;

class PertanyaanDataTable extends DataTable
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

        

        ->addColumn('delete', function($request){
            if($request->ujian->status == 1){    
                return view ('datatable._delete',[
                    'model'    => $request,
                    'delete_url' => route('pertanyaan.destroy', $request->id),
                    'confirm_message' => 'Yakin ingin menghapus Data Pertanyaan?'
                ]);
            }
            else{
                return NULL;
            }                 
        })

        ->addColumn('edit', function($request){
            if($request->ujian->status == 1){   
                return view ('datatable._edit',[
                    'model'    => $request,
                    'edit_url' => route('pertanyaan.edit', $request->id)
                ]);
            }
            else{
                return NULL;
            }                       
        })

        ->editColumn('judul_soal', function($request){
            
            return $request->judul_soal;
        })

        ->rawColumns([ 'delete', 'judul_soal','edit' ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $ujian_id = $this->id;

        $query = mPertanyaan::with('ujian')->where('ujian_id', $ujian_id)->select('m_pertanyaans.*');

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
            // (['data'=> 'foto' ,'name' => 'foto' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            (['data'=> 'judul_soal' ,'name' => 'judul_soal' , 'title' => 'Pertanyaan',]),
            (['data'=> 'opsi1' ,'name' => 'opsi1' , 'title' => 'Opsi 1']),
            (['data'=> 'opsi2' ,'name' => 'opsi2' , 'title' => 'Opsi 2']),
            (['data'=> 'opsi3' ,'name' => 'opsi3' , 'title' => 'Opsi 3']),
            (['data'=> 'opsi4' ,'name' => 'opsi4' , 'title' => 'Opsi 4']),
            (['data'=> 'opsi5' ,'name' => 'opsi5' , 'title' => 'Opsi 5']),
            (['data'=> 'jawaban' ,'name' => 'jawaban' , 'title' => 'Opsi Jawaban']),

            (['data'=> 'edit' ,'name' => 'edit' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            (['data'=> 'delete' ,'name' => 'delete' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            //(['data'=> 'toPertanyaan' ,'name' => 'toPertanyaan' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pertanyaan_' . date('YmdHis');
    }
}
