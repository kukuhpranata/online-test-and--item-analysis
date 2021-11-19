<?php

use Illuminate\Database\Seeder;
use App\mTrainingAttachmentType;

class TrainingAttachmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tat_code = ['SERTIFIKAT','MATERI','LAPORAN'];
        $tat_name = ['Sertifikat Pelatihan','Sertifikat Pelatihan','Sertifikat Pelatihan'];

        foreach($tat_code as $key=>$doc_code){
            $exist = mTrainingAttachmentType::where('tat_code', $doc_code)->first();

            if(!$exist){
                $att_type = mTrainingAttachmentType::create([
                    'tat_code' => $doc_code,
                    'description' => $tat_name[$key]
                ]);
            }
        }

    }
}
