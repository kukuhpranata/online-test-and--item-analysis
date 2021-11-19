<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNotifExpiringTraining extends Mailable
{
    use Queueable, SerializesModels;
    public $pesan, $filepath;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filepath, $pesan)
    {
        $this->pesan = $pesan;
        $this->filepath = $filepath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Informasi Sertifikat Kadaluarsa PT INKA(Persero')
            ->attach($this->filepath)
            ->view('email.mail_notif');
    }
}
