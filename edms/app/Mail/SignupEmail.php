<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SignupEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {   
        $this->email_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'))->view('mail.signup-email', ['email_data' => $this->email_data]);
    }
}
//return $this->from(env('MAIL_USERNAME'), name:'JK Project.org!')->subject(subject:'Welcome to JK PROJECT.ORG!')->view('mail.signup-email', ['email_data' => $this->email_data]);