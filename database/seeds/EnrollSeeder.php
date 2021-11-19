<?php

use Illuminate\Database\Seeder;
use App\mEnrollUjian;

class EnrollSeeder extends Seeder
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
        $nilai_akhir=[
            4, 4, 3, 5, 9, 8, 8, 5, 6, 5,
        ];


        foreach($user_id as $key => $user_id){
            $new_enroll = mEnrollUjian::first();
            
            $new_enroll = new mEnrollUjian();
            $new_enroll->user_id = $user_id;
            $new_enroll->ujian_id = 1;
            $new_enroll->status_daftar =1;
            $new_enroll->status_kehadiran = 2;
            $new_enroll->nilai_akhir = $nilai_akhir[$key];
            $new_enroll->save();
    }
    }
}
