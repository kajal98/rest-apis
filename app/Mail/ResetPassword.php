<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ResetPassword extends Mailable
{
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reset-password')
        ->subject("Password reset successfully")
        ->with([
            'first_name' => $this->first_name,
        ]);
    }
}
