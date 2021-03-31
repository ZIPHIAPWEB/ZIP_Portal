<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class verifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.verifyEmail')
                    ->from('system@ziptravel.com.ph', 'ZIP Travel')
                    ->subject('Email Activation')
                    ->with('verification_link', route('verified', ['email' => $this->user->email, 'token' => $this->user->vToken]));
    }
}
