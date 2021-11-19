<?php

namespace App\DataTables;

use App\User;
use App\mEnrollUjian;
use App\mJawaban;
use App\mUjian;
use Yajra\DataTables\Services\DataTable;
use Auth;

class EnrolledAdminDataTable extends DataTable
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
        ->editColumn('status_kehadiran', function ($request) {
            if($request->status_kehadiran == 1 ){
                return '<center><span class="label bg-orange">Belum Hadir</span></center>';
            }
            if($request->status_kehadiran == 2 ){
                return '<center><span class="label bg-green">Hadir</span></center>';
            }
            else{
                return '<center><span class="label bg-red">Tidak Hadir</span></center>';
            }

        })
        ->editColumn('nilai_akhir', function ($request) {
            $nilai = $request->nilai_akhir;
            $total = $request->ujian->jumlah_soal;
            $hasil = ($nilai/$total)*100;

            return '<center><strong>'.$hasil.'</strong></center>';
        })

        ->addColumn('hasil', function($request){
                return view ('datatable._hasil',[
                    'model'    => $request,
                    'hasil_url' => route('hasiladmin.ujian', [$request->id])
                ]);
        })

            
            ->rawColumns(['status_kehadiran', 'nilai_akhir', 'hasil', ]);
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
        $query = mEnrollUjian::with('user', 'ujian')->where('ujian_id', $ujian_id)->orderBy('user_id', 'ASC')->select('m_enroll_ujians.*');

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
            (['data'=> 'ujian.judul' ,'name' => 'ujian.judul' , 'title' => 'Nama Ujian','visible' => false]),
            (['data'=> 'user.nama' ,'name' => 'user.nama' , 'title' => 'Nama','orderable' => false]),  
            (['data'=> 'user.email' ,'name' => 'user.email' , 'title' => 'Email','orderable' => false]),
            //(['data'=> 'status' ,'name' => 'status' , 'title' => 'Status']),
            (['data'=> 'status_kehadiran' ,'name' => 'status_kehadiran' , 'title' => 'Status Kehadiran']),               
            (['data'=> 'nilai_akhir' ,'name' => 'nilai_akhir' , 'title' => 'Nilai Akhir']),
            (['data'=> 'hasil' ,'name' => 'hasil' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),         
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'EnrolledAdmin_' . date('YmdHis');
    }
}
