<?php

namespace App\Helper;
use Storage;

use App\tAttachment;
use App\tTrainingAttachment;

class SftpHelper
{
    public function storeSftp($ext, $filename , $file_content, $path_from_root, $random_file_name, $act_id){

        try{
            Storage::disk('sftp_attachment')->put($path_from_root.'/'. $filename, $file_content);                        
            $file_exist = Storage::disk('sftp_attachment')->exists($path_from_root.'/'.$filename);

            if($file_exist){
                $path = '/ftp01/dev/monitoring_spi/'.$path_from_root.'/'.$random_file_name;

                // $path = $path_from_root.'/'.$random_file_name;
            
                            
                $attachment = new tAttachment();
                
                // $attachment->attachment_type_id = $attachment_type_id;
                // $attachment->transaction_id = $transaction_id;
                // $attachment->attachment_path = $path;
                // $attachment->file_name = $filename;
                // $attachment->file_extension = $ext;
                // $attachment->path_from_root = $path_from_root;
                $attachment->real_name = $filename;
                $attachment->sftp_path = $path;
                $attachment->save();

                return $attachment;
            }
            else
                return false;

        }catch(Exception $e){
            return false;
        }
    }

    

    public function deleteTrainingSftp($train_attachment_id){
        $file = tTrainingAttachment::find($train_attachment_id);
        
        $delete_status = false;
        try{
            $delete_status = Storage::disk('sftp')->delete($file->path); 
        }catch(Exception $ex)
        {
            $delete_status = false;
        }

        // cek file masih ada atau tidak 
        $file_exist = Storage::disk('sftp')->exists($file->path);

        if($file_exist)
            $delete_status = true;
        else 
            $delete_status = false;
        
        return $delete_status;
    }

    
}