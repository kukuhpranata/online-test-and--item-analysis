<?php

namespace App\DataTables;

use App\User;
use App\mEnrollUjian;
use Yajra\DataTables\Services\DataTable;
use Auth;

class UjianTerdaftarDataTable extends DataTable
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

        ->addColumn('lihatUjian', function($request){
                return view ('datatable._lihat_ujian',[
                    'model'    => $request,
                    'lihat_ujian_url' => route('view.ujian', [$request->ujian->id])
                ]);
        })
        ->addColumn('status', function ($request) {
            if($request->ujian->status == 1 ){
                return '<center><span class="label bg-orange">Pending</span></center>';
            }
            // if($request->ujian->status == 2 ){
            //     return '<span class="label bg-black">Created</span>';
            // }
            elseif($request->ujian->status == 2 ){
                return '<center><span class="label bg-green">Dimulai</span></center>';
            }
            else{
                return '<center><span class="label bg-red">Selesai</span></center>';
            }
        })

        ->editColumn('nilai_akhir', function ($request) {
            $nilai = $request->nilai_akhir;
            $total = $request->ujian->jumlah_soal;
            $hasil = ($nilai/$total)*100;

            return '<center><strong>'.$hasil.'</strong></center>';
        })

        ->addColumn('hasil', function($request){
            if($request->ujian->status == 3 && $request->status_kehadiran == 2 ){
                return view ('datatable._hasil',[
                    'model'    => $request,
                    'hasil_url' => route('hasil.ujian', [$request->id])
                ]);
            }else{
                return NULL;
            }
        })

        ->rawColumns(['status_kehadiran', 'lihatUjian','status', 'nilai_akhir', 'hasil']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = mEnrollUjian::with('user', 'ujian')->where('user_id', Auth::user()->id)->select('m_enroll_ujians.*');

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
        $enroll = mEnrollUjian::with('user', 'ujian')->where('user_id', Auth::user()->id)->first();
        if($enroll->status_kehadiran == 1){
            return [
                (['data'=> 'id' ,'name' => 'id' , 'title' => 'ID',]),
            // (['data'=> 'foto' ,'name' => 'foto' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'ujian.judul' ,'name' => 'ujian.judul' , 'title' => 'Judul','orderable' => false]),             
                (['data'=> 'ujian.tgl_ujian' ,'name' => 'ujian.tgl_ujian' , 'title' => 'Tanggal Ujian','orderable' => false]),
                (['data'=> 'ujian.durasi' ,'name' => 'ujian.durasi' , 'title' => 'Durasi Ujian','orderable' => false]),
                (['data'=> 'status' ,'name' => 'status' , 'title' => 'Status']),
                (['data'=> 'status_kehadiran' ,'name' => 'status_kehadiran' , 'title' => 'Status Kehadiran']),               
                (['data'=> 'lihatUjian' ,'name' => 'lihatUjian' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            ];
        }
        else{
            return [
                (['data'=> 'id' ,'name' => 'id' , 'title' => 'ID',]),
            // (['data'=> 'foto' ,'name' => 'foto' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'ujian.judul' ,'name' => 'ujian.judul' , 'title' => 'Judul','orderable' => false]),
                
                (['data'=> 'ujian.tgl_ujian' ,'name' => 'ujian.tgl_ujian' , 'title' => 'Tanggal Ujian','orderable' => false]),
                // (['data'=> 'ujian.durasi' ,'name' => 'ujian.durasi' , 'title' => 'Durasi Ujian']),
                (['data'=> 'status' ,'name' => 'status' , 'title' => 'Status']),
                (['data'=> 'status_kehadiran' ,'name' => 'status_kehadiran' , 'title' => 'Status Kehadiran']),               
                (['data'=> 'nilai_akhir' ,'name' => 'nilai_akhir' , 'title' => 'Nilai Akhir']),
                (['data'=> 'lihatUjian' ,'name' => 'lihatUjian' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'hasil' ,'name' => 'hasil' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),         
            ];
        }
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'UjianTerdaftar_' . date('YmdHis');
    }
}
