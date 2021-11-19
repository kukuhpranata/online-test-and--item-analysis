<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\MailNotifExpiringTraining;

class SendMailExpiringTraining implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $filepath, $mail_to;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filepath, $mail_to)
    {
        $this->filepath = $filepath;
        // $this->division = $division;
        $this->mail_to = $mail_to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail_to = trim($this->mail_to);
        // $mail_to = 'agri.kridanto@inka.co.id';

        $pesan = '<h2>File Terlampir adalah data sertifikasi yang telah berakhir dan akan berkahir 2 bulan ke depan<h2>'; 
       

        try{
            Mail::to($mail_to)
            ->send(new MailNotifExpiringTraining($this->filepath, $pesan));
            
        }catch(Exception $e){
            dd($e);
        }
    }
}
