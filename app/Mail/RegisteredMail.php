<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisteredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $save;

    /**
     * Create a new message instance.
     *
     * @param mixed $save The user data or relevant information to be included in the email.
     * @return void
     */
    public function __construct($save)
    {
        $this->save = $save;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->markdown('email.registered_mail')
                    ->subject(config('app.name') . ', Registered Mail Password Set');
    }
}