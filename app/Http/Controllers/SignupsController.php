<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Camera;
use App\Library;
use App\Mail\SignupAdminNotification;
use App\Mail\SignupConfirmationNBR;
use App\Mail\SignupConfirmationNBY;
use App\Mail\SignupConfirmationUBR;
use App\Mail\SignupConfirmationUBY;
use App\Signup;
use Illuminate\Support\Facades\Mail;
use App\FormType;
use App\StaticArray;
use Illuminate\Http\Request;
use App\Http\Requests\SignupsFormRequest;
use Session;

class SignupsController extends Controller
{

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create($id)
    {
        $cameras = Camera::all()->sortBy('make');
        $libraries = Library::where('accepting_volunteers_yn','=',1)->get()->sortBy('library_name');
        $st = FormType::$signupFormIDs[$id];
        $counties = StaticArray::$nccounties;
//        $camera = Camera::where('id','=',$signup->camera_id)->first();
        return view('signups.create', compact('id','cameras','libraries', 'st', 'counties'));
    }

    /**
     * @param SignupsFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SignupsFormRequest $request)
    {
        $formid = $request->get('form-type-id');
        $signup = Signup::create($request->except('acf_uploader_yn','acf_borrower_yn', 'deployment_county', 'form-type-id'));
        $id = $signup->id;
        if($formid == 1) {
            $s = Signup::find($id);
            $s->acf_uploader_yn = 0;
            $s->acf_borrower_yn = 1;
            $s->save();
        }
        else if ($formid == 2) {
            $s = Signup::find($id);
            $s->acf_uploader_yn = 0;
            $s->acf_borrower_yn = 0;
            $s->save();
        }
        else if ($formid == 3) {
            $s = Signup::find($id);
            $s->acf_uploader_yn = 1;
            $s->acf_borrower_yn = 1;
            $s->save();
        }
        else if ($formid == 4 ) {
            $s = Signup::find($id);
            $s->acf_uploader_yn = 1;
            $s->acf_borrower_yn = 0;
            $s->save();
        }
        else {
//            dd($formid);
        }

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


//        return redirect()->action('PagesController@home');
        return redirect('https://www.nccandidcritters.org/610-2/sign-up-success-page/');
    }
}