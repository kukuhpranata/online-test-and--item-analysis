<?php

use Illuminate\Database\Seeder;
use App\mUjian;

class Ujian2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ujian = new mUjian();
        $ujian->user_id = 1;
        $ujian->judul ="Simulasi Ujian Komputer";
        $ujian->durasi = 20;
        $ujian->jumlah_soal = 15;
        $ujian->status = 3;
        $ujian->tgl_ujian = '2021-07-08 00:40:00';
        $ujian->save();
    }
}
