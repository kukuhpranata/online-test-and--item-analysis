<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class NotifEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $auditee;
    
     public function __construct($auditee)
    {
       // $this->auditee->$auditee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $sender = 'kukuhpranata000v2@gmail.com';
        return $this->from($sender)
                   ->view('IsiNotifEmail')
                   ->with(
                    [
                        'nama' => 'AAAA',
                    ]);
    }
}
