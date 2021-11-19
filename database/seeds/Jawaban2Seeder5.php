<?php

use Illuminate\Database\Seeder;
use App\mjawaban;

class Jawaban2Seeder5 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pertanyaan_id =[
            11,12,13,14,15,16,17,18,19,20,21,22,23,24,25
        ];

        $j1=[
            3,3,4,2,5,4,5,2,5,1,4,4,3,4,2,
        ];

        $p1=[
            1,1,0,0,0,1,0,1,1,1,1,0,0,1,0,
        ];



            if (is_array($pertanyaan_id) || is_object($pertanyaan_id)){
            foreach($pertanyaan_id as $key => $pertanyaan_id){
                $new_jawaban = mjawaban::first();
                $new_jawaban = new mjawaban();
                $new_jawaban->ujian_id = 2;
                $new_jawaban->user_id = 16;
                $new_jawaban->pertanyaan_id = $pertanyaan_id;
                $new_jawaban->jawaban_user = $j1[$key];
                $new_jawaban->poin = $p1[$key];
                $new_jawaban->save();

            }
    }
    }
}
