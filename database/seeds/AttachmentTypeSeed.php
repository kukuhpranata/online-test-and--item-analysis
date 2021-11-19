<?php

use Illuminate\Database\Seeder;
use App\mAttachmentType;

class AttachmentTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_doc_code = ['EMP_TRAIN','EMP_CAREER','EMP_CONTRACT','EMP_PHOTO'];
        $list_doc_name = ['Doc. Pelatihan Karyawan','Doc. SK Karyawan','Doc. Kontrak Karyawan','Foto Profil Karyawan'];

        foreach($list_doc_code as $key=>$doc_code){
            $exist = mAttachmentType::where('doc_code', $doc_code)->first();

            if(!$exist){
                $att_type = mAttachmentType::create([
                    'doc_code' => $doc_code,
                    'doc_name' => $list_doc_name[$key]
                ]);
            }
        }

    }
}
