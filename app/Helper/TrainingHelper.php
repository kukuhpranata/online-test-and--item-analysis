<?php

namespace App\Helper;
use Storage;

use App\tAttachment;
use App\tTrainingAttachment;
use App\tTrainingHdrFile;
use App\tTrainingDtlFile;

use App\Helper\SftpHelper;
use Auth;
use Carbon\Carbon;

class TrainingHelper
{
    /*
        $type --> 1 train hdr 
              --> 2 train dtl 

        $train_id --> bisa header atau detail
    */
    public function saveAttachment($list_file,$org_code, $train_id, $attachment_type_id, $type){
        
        $sftpHelper = new SftpHelper();
    
        // dd($list_file);

        foreach($list_file as $file){

            $ext = strtolower($file->getClientOriginalExtension());
            $filename = $file->getClientOriginalName();
            $random_file_name = md5($filename. Auth::user()->id .
                Carbon::today()->toDateTimeString()).'.'. $ext;
            $file_content = file_get_contents($file);
            $path_from_root = 'training/' . $org_code;
            
            $attachment = $sftpHelper->storeTrainingSftp(
                $ext, $filename , $file_content, $path_from_root, $random_file_name
            );

            if($attachment){
                if($type == 1){
                    try{
                        $train_hdr_file = tTrainingHdrFile::create([
                            'train_attachment_type_id' => $attachment_type_id,
                            'train_attachment_id' => $attachment->id,
                            'training_hdr_id' => $train_id 
                        ]);
                    }catch(Exception $ex){
                        dd($ex);
                    }
                }else{
                    try{
                        $train_dtl_file = tTrainingDtlFile::create([
                            'train_attachment_type_id' => $attachment_type_id,
                            'train_attachment_id' => $attachment->id,
                            'training_dtl_id' => $train_id 
                        ]);

                        // dd($train_dtl_file);
                    }catch(Exception $ex){
                        dd($ex);
                    }
                    
                }
                
                
   
            }else{
                dd('failed to store laporan file');
            }
        }

        return null;
    }

    /*public function deleteAttachment($train_attachment_id){
        dd($train_attachment_id);
    }*/
}