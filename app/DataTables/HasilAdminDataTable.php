<?php

namespace App\DataTables;

use App\User;
use App\mEnrollUjian;
use App\mJawaban;
use App\mUjian;
use Yajra\DataTables\Services\DataTable;
use Auth;

class HasilAdminDataTable extends DataTable
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
        ->editColumn('poin', function ($request) {
            $mentah = $request->poin;
            $total = $request->ujian->jumlah_soal;
            $poin = ($mentah/$total)*100;

            return '<center><strong>'.$poin.'</strong></center>';
        })


        
        ->rawColumns([ 'poin','pertanyaan.judul_soal']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $enrolled_id = $this->id;
        $enrolled = mEnrollUjian::find($enrolled_id);
        $query = mJawaban::with('user', 'pertanyaan', 'ujian')->where('user_id', $enrolled->user_id)
        ->where('ujian_id', $enrolled->ujian_id)->orderBy('pertanyaan_id', 'ASC')->select('m_jawabans.*');

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
            (['data'=> 'user.nama' ,'name' => 'user.nama' , 'title' => 'Nama User', 'visible' => false]),
            (['data'=> 'ujian.judul' ,'name' => 'ujian.judul' , 'title' => 'Nama Ujian','visible' => false]),
            //(['data'=> 'pertanyaan.id' ,'name' => 'pertanyaan.id' , 'title' => 'ID Pertanyaan','orderable' => false]),
            (['data'=> 'pertanyaan.judul_soal' ,'name' => 'pertanyaan.judul_soal' , 'title' => 'Pertanyaan','orderable' => false]),
            // (['data'=> 'pertanyaan.opsi1' ,'name' => 'pertanyaan.opsi1' , 'title' => 'Opsi 1']),
            // (['data'=> 'pertanyaan.opsi2' ,'name' => 'pertanyaan.opsi2' , 'title' => 'Opsi 2']),
            // (['data'=> 'pertanyaan.opsi3' ,'name' => 'pertanyaan.opsi3' , 'title' => 'Opsi 3']),
            // (['data'=> 'pertanyaan.opsi4' ,'name' => 'pertanyaan.opsi4' , 'title' => 'Opsi 4']),
            // (['data'=> 'pertanyaan.opsi5' ,'name' => 'pertanyaan.opsi5' , 'title' => 'Opsi 5']),
            (['data'=> 'pertanyaan.jawaban' ,'name' => 'pertanyaan.jawaban' , 'title' => 'Kunci Jawaban','orderable' => false]),
            (['data'=> 'jawaban_user' ,'name' => 'jawaban_user' , 'title' => 'Jawaban Anda','orderable' => false]),
            (['data'=> 'poin' ,'name' => 'poin' , 'title' => 'Poin',]),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'HasilAdmin_' . date('YmdHis');
    }
}
