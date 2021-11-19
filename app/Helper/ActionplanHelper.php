<?php

namespace App\Helper;
use Storage;

use App\tAttachment;

use Auth;
use Carbon\Carbon;

class ActionplanHelper
{
   
    public function saveAttachmentProgress($file, $act_id){

        $ext = strtolower($file->getClientOriginalExtension());
        $filename = $file->getClientOriginalName();
        $random_file_name = md5($filename. Auth::user()->id .
            Carbon::today()->toDateTimeString()).'.'. $ext;
        $file_content = file_get_contents($file);
        $path_from_root = 'attachment';

        try{
            Storage::disk('sftp')->put($path_from_root.'/'. $random_file_name, $file_content);                     
            $file_exist = Storage::disk('sftp')->exists($path_from_root.'/'.$random_file_name);
            
            if($file_exist){

                $path = $path_from_root.'/'.$random_file_name;
            
                            
                $attachment = new tAttachment();

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
}