<?php

namespace App\Mail;

use App\SiteDescription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SiteSelectionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $sd;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SiteDescription $sd)
    {
        $this->sd = $sd;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.site-descriptions.site-selection-confirmation')
            ->subject('Thanks for selecting a deployment site!')
            ->with([
                'dt' => Carbon::now()
            ]);
    }
}
