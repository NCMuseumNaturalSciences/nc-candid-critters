<?php

namespace App\Mail;
use App\SiteDescription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SiteDescriptionConfirmationU extends Mailable
{
    use Queueable, SerializesModels;

    public $sd,$dt;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sd)
    {
        $this->sd = $sd;
        $this->dt = Carbon::now();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.site-descriptions.uploader-confirmation')
            ->subject('Thanks for submitting your site description!');
    }
}
