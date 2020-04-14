<?php

namespace App\Mail;
use Carbon\Carbon;
use App\SiteDescription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SiteDescriptionAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SiteDescription $description)
    {
        $this->description = $description;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin.site-description-notification')
            ->subject('New NCCC Site Description Submission')
            ->with([
                'id' => $this->description->id,
                'first_name' => $this->description->first_name,
                'last_name' => $this->description->last_name,
                'email' => $this->description->email,
                'borrower_yn' => $this->description->acf_borrower_yn,
                'uploader_yn' => $this->description->acf_uploader_yn,
                'created' => Carbon::Now()
            ]);
    }
}
