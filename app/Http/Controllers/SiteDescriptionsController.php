<?php

namespace App\Http\Controllers;
use App\Mail\MapSelectionAdminNotification;
use App\Volunteer;
use Carbon\Carbon;
use App\Mail\SiteSelectionConfirmation;
use App\Mail\SiteDescriptionConfirmationN;
use App\Mail\SiteDescriptionConfirmationU;
use App\StaticArray;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SiteDescriptionFormRequest;
use App\SiteDescription;
use Illuminate\Http\Request;
use App\Camera;
use App\Library;
use App\FormType;
use DB;
use App\MapSite;

class SiteDescriptionsController extends Controller
{
    public function create($id)
    {
        $cameras = Camera::all();
        $libraries = Library::all();
        $st = FormType::$siteDescriptionFormIDs[$id];
        $counties = StaticArray::$nccounties;
        return view('site-descriptions.create', compact('id','cameras','libraries', 'st','counties'));
    }

    public function store(SiteDescriptionFormRequest $request)
    {
        $formid = $request->get('form-type-id');
        $fname = ucfirst(strtolower($request->get('first_name')));
        $finitial = $fname[0];
        $lname = ucfirst(strtolower($request->get('last_name')));
        $county = $request->get('county');
        if($request->has('emmammal_user_id')) {
            $emammal_yn = 1;
        }
        else {
            $emammal_yn = 0;
        }
        $description = SiteDescription::create($request->except('byo_borrower', 'form-type-id'));
        // Create deployment name
        $deploymentName = $lname ."_". $finitial ."_". $county ."_".$description->id;
        // Update with deployment name
        SiteDescription::find($description->id)->update(
            [
                'emammal_created_yn' => $emammal_yn,
                'acf_lat' => $description->user_latitude,
                'acf_long' => $description->user_longitude,
                'deployment_name' => $deploymentName
            ]);
        // Now get updated record
        $sd = SiteDescription::where('id','=',$description->id)->first();


        // Send Email
        $email = $request->get('email');
        $full_name = $request->get('first_name') . ' ' . $request->get('last_name');

        $recipients = [
            array('email' => $email, 'name' => $full_name),
//            array('email' => 'mbhendri@ncsu.edu', 'name' => 'Monica'),
            array('email' => 'michaelnorton.ben@gmail.com', 'name' => 'Ben Norton'),
//            array('email' => 'ben.norton@naturalsciences.org', 'name' => 'Ben Norton'),
        ];

        if($formid == 1) {
            Mail::to($recipients)
                ->send(new SiteDescriptionConfirmationN($sd));
        }
        else {
            Mail::to($recipients)
                ->send(new SiteDescriptionConfirmationU($sd));
        }
//        Mail::to($adminemails)->send(new SiteDescriptionAdminNotification($description));

        return redirect('https://www.nccandidcritters.org/610-2/sdf-success-page/');
    }

    /**
     * Store Map Site Selection by User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSelection(Request $request)
    {
        $post = $request->all();
        $s = MapSite::find($post['id']);
        if($s) {
            $sd = new SiteDescription();
            $sd->deployment_name = $s->site_name;
            $sd->first_name = $post['first_name'];
            $sd->last_name = $post['last_name'];
            $sd->email = $post['email'];
            $sd->acf_lat = $s->lat;
            $sd->acf_long = $s->lon;
            $sd->county = $s->county;
            $sd->property_name = $s->property_name;
            $sd->gsheet_src = $s->source_gsheet_name;
            $sd->map_site_id = $s->id;
            $sd->created_at = Carbon::now()->toDateString();
            $sd->updated_at = Carbon::now()->toDateString();
            $sd->save();

            DB::table('map_sites')
                ->where('id', $s->id)
                ->update([
                    'available_yn' => 0,
                    'display_on_map_yn' => 0,
                    'status' => 'Unavailable'
                ]);

            $email = $request->get('email');
            $full_name = $request->get('first_name') . ' ' . $request->get('last_name');


            $recipients = [
                $email, 'michaelnorton.ben@gmail.com'
            ];

            $sd = SiteDescription::where('map_site_id','=',$post['id'])->first();
            Mail::to($recipients)
                ->send(new SiteSelectionConfirmation($sd));
            //Mail::to($admin)
            //    ->send(new MapSelectionAdminNotification($sd));

        }
        //return redirect()->action('PagesController@home');
       return redirect('https://www.nccandidcritters.org/610-2/site-selection-success-page/');
    }


}
