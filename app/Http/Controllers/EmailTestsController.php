<?php

namespace App\Http\Controllers;
use App\MapSite;
use App\SiteDescription;
use App\User;
use Auth;
use Session;
use Mail;
use Illuminate\Http\Request;
use App\Mail\SiteSelectionConfirmation;
use App\Mail\MapSelectionAdminNotification;
use App\Mail\SignupConfirmationNBR;
use App\Mail\SignupConfirmationNBY;
use App\Mail\SignupConfirmationUBR;
use App\Mail\SignupConfirmationUBY;
class EmailTestsController extends Controller
{
    private $emails;

    public function __construct()
    {
        $this->emails = [
            'info@nccandidcritters.org', 'mbhendri@ncsu.edu', 'michaelnorton.ben@gmail.com', 'nebulabase@gmail.com', 'ben.norton@naturalsciences.org'
        ];
    }

    /**
     * Generic email test using the user_id
     *
     */

	public function sendBlankTest($id)
	{
			$user = User::find($id);
			$data = array('name' => $user->fname, 'email' => $user->email);
			Mail::send('emails.test', $data, function($message) use ($data)
			{
				$message->to($data['email'], $data['name'])->subject('Test Email');
			});
	        Session::flash('flash_message', 'Test Email Sending Complete for ' . $data['name'] . ' at ' . $data['email']);
	        return redirect()->action('PagesController@home');
	}

    /**
     * Test the Admin Notification when a user selects a site using the site selection map
     *
     */
    public function sendMapSelectionAdminTest()
    {
//        $sd = SiteDescription::whereNotNull('map_site_id')->inRandomOrder()->first();
        $sd = MapSite::inRandomOrder()->first();

        $recipients = $this->emails;
        Mail::to($recipients)
            ->send(new MapSelectionAdminNotification($sd));
        Session::flash('flash_message', 'Map Selection Admin Notification Email Test Complete for ' . $recipients[0]);
        return redirect()->action('PagesController@home');
    }

    /**
     * Test the User Notification after selecting a site using the site selection map
     * Paired with sendMapSelectionAdminTest
     *
     */
    public function sendSiteSelectionConfirmationTest()
    {
//        $sd = SiteDescription::whereNotNull('map_site_id')->inRandomOrder()->first();
        $sd = MapSite::inRandomOrder()->first();
        $recipients = $this->emails;
        Mail::to($recipients)
            ->send(new SiteSelectionConfirmation($sd));
        Session::flash('flash_message', 'Site Selection Confirmation Email Test Complete for ' . $recipients[0]);
        return redirect()->action('PagesController@home');
    }

    /**
     * Test the user confirmation email when a user submits the signup form
     *
     */
    public function sendTestSignupsConfirmation($formid)
    {
        $s = Signup::inRandomOrder()->first();
        $recipients = $this->emails;
        if($formid == 1) {
            Mail::to($recipients)
                ->send(new SignupConfirmationNBR());
        }
        elseif ($formid == 2) {
            Mail::to($recipients)
                ->send(new SignupConfirmationNBY());
        }
        elseif ($formid == 3) {
            Mail::to($recipients)
                ->send(new SignupConfirmationUBR());
        }
        else {
            Mail::to($recipients)
                ->send(new SignupConfirmationUBY());
        }
    }
}
