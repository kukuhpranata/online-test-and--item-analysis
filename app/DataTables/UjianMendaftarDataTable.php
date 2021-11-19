<?php

namespace App\DataTables;

use App\User;
use App\mEnrollUjian;
use App\mUjian;
use Yajra\DataTables\Services\DataTable;

class UjianMendaftarDataTable extends DataTable
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
        ->addColumn('daftar', function($request){
            if($request->status_daftar == NULL ){
                return view ('datatable._daftar',[
                    'model'    => $request,
                    'daftar_url' => route('view.ujian', [$request->id])
                ]);
            }
            if($request->status_daftar == 1 ){
                return '<span class="label bg-orange">Request</span>';
            }
            if($request->status_daftar == 2 ){
                return '<span class="label bg-green">Ditolak</span>';
            }
            else{
                return '<span class="label bg-red">Diterima/span>';
            }
        })

        ->rawColumns(['status_daftar']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = mEnrollUjian::with('user', 'ujian')->where('status_daftar', '!=', 3 )->select('m_enroll_ujians.*');

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
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
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
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return [
            (['data'=> 'id' ,'name' => 'id' , 'title' => 'ID',]),
            (['data'=> 'ujian.judul' ,'name' => 'ujian.judul' , 'title' => 'Judul',]),
            (['data'=> 'ujian.tanggal' ,'name' => 'ujian.tanggal' , 'title' => 'Tanggal Ujian']),
            (['data'=> 'ujian.durasi' ,'name' => 'ujian.durasi' , 'title' => 'Durasi Ujian']),
            (['data'=> 'status_daftar' ,'name' => 'status_daftar' , 'title' => 'Request Daftar']),
        ];
    }
}
