<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComposeEmailMail extends Mailable
{
    use Queueable, SerializesModels;
   
    public $save;

    public function __construct($save)
    {
        // You can pass the email content data like subject, body, etc.
        $this->save = $save;
    }

    public function build(){
        return $this->markdown('email.compose_email_mail')->subject(config('app.name').',New Mail Send');
    }
}