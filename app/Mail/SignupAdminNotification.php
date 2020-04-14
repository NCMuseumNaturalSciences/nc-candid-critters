<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Signup;
use Carbon\Carbon;

class SignupAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $signup;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Signup $signup)
    {
        $this->signup = $signup;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin.signup-notification')
            ->subject('New NCCC Signup Submitted')
            ->with([
                'id' => $this->signup->id,
                'first_name' => $this->signup->first_name,
                'last_name' => $this->signup->last_name,
                'email' => $this->signup->email,
                'borrower_yn' => $this->signup->acf_borrower_yn,
                'uploader_yn' => $this->signup->acf_uploader_yn,
                'created' => Carbon::Now()
            ]);
    }
}
