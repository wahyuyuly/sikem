<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivationUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailData;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@poltekkes-tjk.ac.id', 'SIAKEM')
            ->subject('Aktivasi Akun SIAKEM')
            ->markdown('mails.activationuser')
            ->with($this->mailData);
    }
}
