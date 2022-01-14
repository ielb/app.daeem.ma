<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $action;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData,$action)
    {
        $this->mailData = $mailData;
        $this->action = $action;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->action == 'reset'){
            return $this->markdown('emails.reset')
                ->with('mailData', $this->mailData)
                ->subject('Reset Password');
        }
        return $this->markdown('emails.confirmation')
            ->with('mailData', $this->mailData)
            ->subject('Email Confirmation');
    }
}
