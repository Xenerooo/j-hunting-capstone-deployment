<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $account;

    public function __construct($account)
    {
        $this->account = $account;
    }

    public function build()
    {
        $url = url('/verify-email?token=' . $this->account->verify_token);

        return $this->subject('Verify your email address')
            ->view('auth.email.verification')
            ->with([
                'account' => $this->account,
                'verifyUrl' => $url,
            ]);
    }
}
