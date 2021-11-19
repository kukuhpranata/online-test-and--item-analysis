<?php

use Illuminate\Database\Seeder;
use App\mjawaban;

class JawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = [
            2,3,4,5,6,7,8,9,10,11,
        ];

        $pertanyaan_id =[
            1,2,3,4,5,6,7,8,9,10,
        ];

        $j1=[
            1,1,2,2,2,1,2,2,1,2,
        ];

        $j2=[
            1,1,1,2,2,1,2,2,2,2,
        ];

        $j3=[
            1,2,2,1,2,1,2,2,2,2,
        ];

        $j4=[
            1,1,1,2,2,1,2,1,2,2,
        ];

        $j5=[
            1,1,1,1,1,1,1,1,1,2,
        ];

        $j6=[
            1,1,1,1,1,2,1,1,1,2,
        ];

        $j7=[
            1,1,1,1,1,2,1,1,1,2,
        ];

        $j8=[
            1,2,1,2,1,2,1,2,2,1,
        ];

        $j9=[
            1,1,1,1,2,2,1,2,2,1,
        ];

        $j10=[
            2,1,2,1,1,2,1,2,2,1,
        ];

        $p1=[
            1,1,0,0,0,1,0,0,1,0,
        ];

        $p0=[
            1,1,1,0,0,1,0,0,0,0,
        ];

        $p3=[
            1,0,0,1,0,1,0,0,0,0,
        ];

        $p4=[
            1,1,1,0,0,1,0,1,0,0,
        ];

        $p5=[
            1,1,1,1,1,1,1,1,1,0,
        ];

        $p6=[
            1,1,1,1,1,0,1,1,1,0,
        ];

        $p7=[
            1,1,1,1,1,0,1,1,1,0,
        ];

        $p8=[
            1,0,1,0,1,0,1,0,0,1,
        ];

        $p9=[
            1,1,1,1,0,0,1,0,0,1,
        ];

        $p10=[
            0,1,0,1,1,0,1,0,0,1,
        ];


            if (is_array($pertanyaan_id) || is_object($pertanyaan_id)){
            foreach($pertanyaan_id as $key => $pertanyaan_id){
                $new_jawaban = mjawaban::first();
                $new_jawaban = new mjawaban();
                $new_jawaban->ujian_id = 1;
                $new_jawaban->user_id = 2;
                $new_jawaban->pertanyaan_id = $pertanyaan_id;
                $new_jawaban->jawaban_user = $j1[$key];
                $new_jawaban->poin = $p1[$key];
                $new_jawaban->save();

            }

            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 3;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j2[$key];
            //     $new_jawaban->poin = $p2[$key];
            //     $new_jawaban->save();

            // }}

            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 4;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j3[$key];
            //     $new_jawaban->poin = $p3[$key];
            //     $new_jawaban->save();

            // }

            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 5;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j4[$key];
            //     $new_jawaban->poin = $p4[$key];
            //     $new_jawaban->save();

            // }

            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 6;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j5[$key];
            //     $new_jawaban->poin = $p5[$key];
            //     $new_jawaban->save();

            // }
         
            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 7;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j6[$key];
            //     $new_jawaban->poin = $p6[$key];
            //     $new_jawaban->save();

            // }

            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 8;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j7[$key];
            //     $new_jawaban->poin = $p7[$key];
            //     $new_jawaban->save();

            // }

            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 9;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j8[$key];
            //     $new_jawaban->poin = $p8[$key];
            //     $new_jawaban->save();
            // }

            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 10;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j9[$key];
            //     $new_jawaban->poin = $p9[$key];
            //     $new_jawaban->save();

            // }

            // foreach($pertanyaan_id as $key => $pertanyaan_id){
            //     $new_jawaban = mjawaban::first();
            //     $new_jawaban = new mjawaban();
            //     $new_jawaban->ujian_id = 1;
            //     $new_jawaban->user_id = 11;
            //     $new_jawaban->pertanyaan_id = $pertanyaan_id;
            //     $new_jawaban->jawaban_user = $j10[$key];
            //     $new_jawaban->poin = $p10[$key];
            //     $new_jawaban->save();

            // }
    }
}
}