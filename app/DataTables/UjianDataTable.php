<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
Use App\mUjian;
use App\mEnrollUjian;
use App\mPertanyaan;
use Carbon;
use Auth;

class UjianDataTable extends DataTable
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
            if($request->status == 1 ){
                return view ('datatable._edit',[
                    'model'    => $request,
                    'edit_url' => route('ujian.edit', $request->id)
                ]);
            }
            else{
                NULL;
            }                      
        })

        ->addColumn('delete', function($request){   
            if($request->status == 1 ){ 
                return view ('datatable._delete',[
                    'model'    => $request,
                    'delete_url' => route('ujian.destroy', $request->id),
                    'confirm_message' => 'Yakin ingin menghapus Data Ujian ' . $request->judul . '?'
                ]);
            }
            else{
                NULL;
            }                 
        })

        ->addColumn('status', function ($request) {
            if($request->status == 1 ){
                return '<span class="label bg-orange">Pending</span>';
            }
            // if($request->status == 2 ){
            //     return '<span class="label bg-black">Created</span>';
            // }
            elseif($request->status == 2 ){
                return '<span class="label bg-green">Dimulai</span>';
            }
            else{
                return '<span class="label bg-red">Selesai</span>';
            }
        })

        ->addColumn('tanggal', function ($request) {
            $waktu = $request->tgl_ujian;
            $waktubaru = Carbon\Carbon::parse($waktu)->format('d F Y h:iA');
            return $waktubaru;

        })

        ->editColumn('tgl_ujian_end', function($request){
            $waktuend = Carbon\Carbon::parse($request->tgl_ujian_end)->format('d F Y h:iA');
            return $waktuend;
        })

        ->addColumn('toPertanyaan', function($request){
            if(Auth::user()->role_id == 1 ){
                return view ('datatable._actionplan',[
                    'model'    => $request,
                    'actionplan_url' => route('pertanyaanindex', [$request->id])
                ]);
            }else{
                return NULL;
            }
        })

        ->editColumn('durasi', function($request){
            return $request->durasi . ' Menit';
        })

        ->addColumn('lihatUjian', function($request){
            if(Auth::user()->role_id == 1 ){
                return view ('datatable._lihat_ujian',[
                    'model'    => $request,
                    'lihat_ujian_url' => route('view.ujian', [$request->id])
                ]);
            }else{
                return NULL;
            }
        })

        ->addColumn('daftar', function($request){
           // $ujian = mUjian::where('id', $request->id)->first();
            $ujian_id = $request->id;
            $user = Auth::user() ->id;
    
            $enrolled = mEnrollUjian::where([
                ['user_id', $user],
                ['ujian_id', $ujian_id],
            ])->first();
            
            if($enrolled == null){
                return view ('datatable._daftar',[
                    'model'    => $request,
                    'daftar_url' => route('daftar.store', [$request->id]),
                    'confirm_message' => 'Yakin untuk mendaftar'.$request->judul. '?'
                ]);
            }
            else{
                return '<span class="label bg-green">Enrolled</span>';
            }
        })


        ->addColumn('mulai', function($request){
            $now = Carbon\Carbon::now()->addHours(7);
            $mulai = Carbon\Carbon::parse($request->tgl_ujian)->subMinutes(5);
            $akhir = Carbon\Carbon::parse($request->tgl_ujian_end);
            if($request->status == 1 && $mulai <= $now ){
                return view ('datatable._mulai',[
                    'model'    => $request,
                    'mulai_url' => route('mulai.ujian', [$request->id]),
                    'confirm_message' => 'Mulai Ujian ' . $request->judul . ' Sekarang?'
                ]);
            }
            elseif($request->status == 2 && $akhir <= $now){
                return view ('datatable._selesai',[
                    'model'    => $request,
                    'selesai_url' => route('selesai.ujian', [$request->id]),
                    'confirm_message' => 'Hentikan Ujian ' . $request->judul . ' Sekarang?'
                ]);
            }
            else{
                NULL;
            }
        })

        ->addColumn('enrolled', function($request){
                return view ('datatable._enrolled',[
                    'model'    => $request,
                    'enrolled_url' => route('ujian.enrolled', [$request->id]),
                ]);
        })

        ->addColumn('analisis', function($request){
            $enrolled = mEnrollUjian::where('ujian_id', $request->id)->count();
            $pertanyaan = mPertanyaan::where('ujian_id', $request->id)->count();
            if($request->status == 3 && $enrolled >= 10 && $pertanyaan >= $request->jumlah_soal){
                return view ('datatable._analisis',[
                    'model'    => $request,
                    'analisis_url' => route('analisis.ujian', [$request->id]),
                ]);
            }
            elseif($request->status == 3 && $enrolled < 10 && $pertanyaan < $request->jumlah_soal){
                return '<span class="label bg-red">Tidak memenuhi syarat</span>';
            }
            else{
                NULL;
            }
        })

        

        

        ->rawColumns(['edit','delete', 'status', 'toPertanyaan', 'lihatUjian', 'daftar', 'mulai', 'analisis', 'enrolled']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        if(Auth::user()->role_id == 1){
            $query = mUjian::with('user')->select('m_ujians.*');
        }
        else{
            $query = mUjian::with('user')->where('status', '!=', '3')->select('m_ujians.*');
        }
        

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
        if(Auth::user()->role_id == 1 ){
            return [
                (['data'=> 'id' ,'name' => 'id' , 'title' => 'ID',]),
            // (['data'=> 'foto' ,'name' => 'foto' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'judul' ,'name' => 'judul' , 'title' => 'Judul',]),
                (['data'=> 'user.email' ,'name' => 'user.email' , 'title' => 'Creator','orderable' => false]),
                (['data'=> 'tanggal' ,'name' => 'tanggal' , 'title' => 'Waktu Mulai']),
                (['data'=> 'tgl_ujian_end' ,'name' => 'tgl_ujian_end' , 'title' => 'Waktu Selesai']),
                (['data'=> 'durasi' ,'name' => 'durasi' , 'title' => 'Durasi Ujian']),
                (['data'=> 'status' ,'name' => 'status' , 'title' => 'Status']),
                

                (['data'=> 'edit' ,'name' => 'edit' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'delete' ,'name' => 'delete' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'toPertanyaan' ,'name' => 'toPertanyaan' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'lihatUjian' ,'name' => 'lihatUjian' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'mulai' ,'name' => 'mulai' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'enrolled' ,'name' => 'enrolled' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'analisis' ,'name' => 'analisis' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
            ];
        }else{
            return [
                // (['data'=> 'id' ,'name' => 'id' , 'title' => 'ID',]),
            // (['data'=> 'foto' ,'name' => 'foto' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                (['data'=> 'judul' ,'name' => 'judul' , 'title' => 'Judul',]),
                // (['data'=> 'user.email' ,'name' => 'user.email' , 'title' => 'Creator']),
                (['data'=> 'tanggal' ,'name' => 'tanggal' , 'title' => 'Waktu Mulai']),
                (['data'=> 'tgl_ujian_end' ,'name' => 'tgl_ujian_end' , 'title' => 'Waktu Selesai']),
                (['data'=> 'durasi' ,'name' => 'durasi' , 'title' => 'Durasi Ujian']),
                //(['data'=> 'status' ,'name' => 'status' , 'title' => 'Status']),

                (['data'=> 'daftar' ,'name' => 'daftar' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                // (['data'=> 'delete' ,'name' => 'delete' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                // (['data'=> 'toPertanyaan' ,'name' => 'toPertanyaan' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
                // (['data'=> 'lihatUjian' ,'name' => 'lihatUjian' , 'title' => '' ,'orderable' => false,'searchable' => false, 'exportable' => false, 'printable'  => false, 'width' => '25px']),
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
        return 'Ujian_' . date('YmdHis');
    }
}
