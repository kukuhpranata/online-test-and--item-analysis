<?php

use Illuminate\Database\Seeder;
use App\mUjian;

class UjianSeeder extends Seeder
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
        $ujian->judul ="Simulasi Ujian";
        $ujian->durasi = 10;
        $ujian->jumlah_soal = 10;
        $ujian->status = 3;
        $ujian->tgl_ujian = '2021-06-23 00:40:00';
        $ujian->save();
    }
}
