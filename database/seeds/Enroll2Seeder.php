<?php

use Illuminate\Database\Seeder;
use App\mEnrollUjian;

class Enroll2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = [
            12,13,14,15,16,17,18,19,20,21,
        ];
        $nilai_akhir=[
            9, 3,9,10,8,9,6,14,11,10
        ];


        foreach($user_id as $key => $user_id){
            $new_enroll = mEnrollUjian::first();
            
            $new_enroll = new mEnrollUjian();
            $new_enroll->user_id = $user_id;
            $new_enroll->ujian_id = 2;
            $new_enroll->status_daftar =1;
            $new_enroll->status_kehadiran = 2;
            $new_enroll->nilai_akhir = $nilai_akhir[$key];
            $new_enroll->save();
    }
    }
}
