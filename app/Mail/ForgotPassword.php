<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ForgotPassword extends Mailable
{
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name, $link)
    {
        $this->first_name = $first_name;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.forgot-password')
        ->subject("Reset your password")
        ->with([
            'first_name' => $this->first_name,
            'link' => $this->link,
        ]);
    }
}
