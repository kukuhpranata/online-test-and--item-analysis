<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;
use App\mPertanyaan;
use Carbon;
use Auth;

class AnalisisDataTable extends DataTable
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
            return view ('datatable._delete',[
                'model'    => $request,
                'delete_url' => route('pertanyaan.destroy', $request->id),
                'confirm_message' => 'Yakin ingin menghapus Data Pertanyaan?'
            ]);                 
        })

        ->addColumn('edit', function($request){
            return view ('datatable._edit',[
                'model'    => $request,
                'edit_url' => route('pertanyaan.edit', $request->id)
            ]);                       
        })

        ->editColumn('judul_soal', function($request){
            
            return $request->judul_soal;
        })

        ->editColumn('nilai_derajat_kesukaran', function($request){
            
            if($request->nilai_derajat_kesukaran >= 0 && $request->nilai_derajat_kesukaran < 0.3){
                return '<center><strong>'.$request->nilai_derajat_kesukaran. '<br>(SUKAR)</strong></center>';
            }
            elseif($request->nilai_derajat_kesukaran >= 0.3 && $request->nilai_derajat_kesukaran < 0.7){
                return '<center><strong>'.$request->nilai_derajat_kesukaran. '<br>(SEDANG)</strong></center>';
            }
            else{
                return '<center><strong>'.$request->nilai_derajat_kesukaran. '<br>(MUDAH)</strong></center>';
            }
        })

        ->editColumn('nilai_dayabeda', function($request){
            
            if($request->nilai_dayabeda >= 0 && $request->nilai_dayabeda < 0.2){
                return '<center><strong>'.$request->nilai_dayabeda. '<br>(JELEK)</strong></center>';
            }
            elseif($request->nilai_dayabeda >= 0.2 && $request->nilai_dayabeda < 0.4){
                return '<center><strong>'.$request->nilai_dayabeda. '<br>(CUKUP)</strong></center>';
            }
            elseif($request->nilai_dayabeda >= 0.4 && $request->nilai_dayabeda < 0.7){
                return '<center><strong>'.$request->nilai_dayabeda. '<br>(BAIK)</strong></center>';
            }
            elseif($request->nilai_dayabeda >= 0.7 && $request->nilai_dayabeda <= 1){
                return '<center><strong>'.$request->nilai_dayabeda. '<br>(SANGAT BAIK)</strong></center>';
            }
            else{
                return '<center><strong>'.$request->nilai_dayabeda. '<br>(SEBAIKNYA DIGANTI)</strong></center>';
            }
        })

        ->editColumn('nilai_validitas', function($request){
            
            if($request->ujian->jumlah_soal == 5){
                $r = 0.997;
            }
            elseif($request->ujian->jumlah_soal == 10){
                $r = 0.707;
            }
            elseif($request->ujian->jumlah_soal == 15){
                $r = 0.553;
            }
            elseif($request->ujian->jumlah_soal == 20){
                $r = 0.468;
            }
            elseif($request->ujian->jumlah_soal == 25){
                $r = 0.413;
            }
            elseif($request->ujian->jumlah_soal == 30){
                $r = 0.374;
            }
            elseif($request->ujian->jumlah_soal == 40){
                $r = 0.320;
            }
            else{
                $r = 0.284;
            }

            if($request->nilai_validitas > $r){
                return '<center><strong>'.$request->nilai_validitas. '<br>(VALID)</strong></center>';
            }
            else{
                return '<center><strong>'.$request->nilai_validitas. '<br>(INVALID)</strong></center>';
            }
        })

        ->editColumn('fungsi_pengecoh', function($request){
            return '<center><strong>'.$request->fungsi_pengecoh.' %</strong><br>Memilih Pengecoh</center>';
        })

        ->rawColumns([ 'delete', 'judul_soal','edit', 'nilai_derajat_kesukaran', 'nilai_dayabeda', 'nilai_validitas', 'fungsi_pengecoh' ]);
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
                (['data'=> 'judul_soal' ,'name' => 'judul_soal' , 'title' => 'Pertanyaan',]),
                // (['data'=> 'opsi1' ,'name' => 'opsi1' , 'title' => 'Opsi 1']),
                // (['data'=> 'opsi2' ,'name' => 'opsi2' , 'title' => 'Opsi 2']),
                // (['data'=> 'opsi3' ,'name' => 'opsi3' , 'title' => 'Opsi 3']),
                // (['data'=> 'opsi4' ,'name' => 'opsi4' , 'title' => 'Opsi 4']),
                // (['data'=> 'opsi5' ,'name' => 'opsi5' , 'title' => 'Opsi 5']),
                // (['data'=> 'jawaban' ,'name' => 'jawaban' , 'title' => 'Opsi Jawaban']),
                (['data'=> 'nilai_derajat_kesukaran' ,'name' => 'nilai_derajat_kesukaran' , 'title' => 'Derajat Kesukaran']),
                (['data'=> 'nilai_dayabeda' ,'name' => 'nilai_dayabeda' , 'title' => 'Daya Beda']),
                (['data'=> 'fungsi_pengecoh' ,'name' => 'fungsi_pengecoh' , 'title' => 'Efektivitas Pengecoh']),
                (['data'=> 'nilai_validitas' ,'name' => 'nilai_validitas' , 'title' => 'Nilai Validitas']),
            ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Analisis_' . date('YmdHis');
    }
}
