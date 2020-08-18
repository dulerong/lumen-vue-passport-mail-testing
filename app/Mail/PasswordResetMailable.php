<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $username;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $username, $url)
    {
        $this->token = $token;
        $this->username = $username;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Reset')->view('PasswordReset');
    }
}