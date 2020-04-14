<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\MapSitesFormRequest;
use Validator;
use App\Library;
use App\Camera;
use App\FormType;
use App\TrainingStatus;
use Auth;
use App\User;
use DB;
use App\Volunteer;
use App\Signup;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SignupsDataTable;
use App\DataTables\SignupsDataTablesEditor;
use App\StaticArray;
class SignupsController extends Controller
{
    /**
     * Display a listing of the resource.
     * Type = 1 all
     * Type = 2 unactivated
     * Type = 3 activated
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $title = "All";
        $type = 1;
        $properties = array('title' => $title, 'type' => $type);
        return view('admin.signups.datatable')->with($properties);
        */
        return view('admin.signups.all-datatable');
    }
    public function unactivated()
    {
        return view('admin.signups.unactivated-datatable');
    }
    public function activated()
    {
        return view('admin.signups.activated-datatable');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $signup = Signup::find($id);
        $libraries = Library::all();
        $library = Library::where('id','=',$signup->library_id)->first();
        $statusSet = TrainingStatus::all();
        $camera = Camera::where('id','=',$signup->camera_id)->first();
        $user = Auth::user();
        return view('admin.signups.show', compact('signup','library','camera','user','libraries','statusSet'));
    }
    /**
     * Edit the specified resource
     * Deferred on 9/26 for Modal Option
*/
    public function edit($id)
    {
        $cameras = Camera::all();
        $signup = Signup::find($id);
        $libraries = Library::all();
        $counties = StaticArray::$nccounties;
        if($signup->acf_uploader_yn == 0 && $signup->acf_borrower_yn == 1) {
            $signuptype = '1';
            $formtitle = "Non-uploader Borrower";
            $camera = null;
            $library = Library::where('id','=',$signup->library_id)->first();
        }
        else if($signup->acf_uploader_yn == 0 && $signup->acf_borrower_yn == 0) {
            $signuptype = '2';
            $formtitle = "Non-uploader BYO";
            $camera = Camera::where('id','=',$signup->camera_id)->first();
            $library = null;
        }
        else if($signup->acf_uploader_yn == 1 && $signup->acf_borrower_yn == 1) {
            $signuptype = '3';
            $formtitle = "Uploader Borrower";
            $camera = null;
            $library = Library::where('id','=',$signup->library_id)->first();
        }
        else if($signup->acf_uploader_yn == 1 && $signup->acf_borrower_yn == 0) {
            $signuptype = '4';
            $formtitle = "Uploader BYO";
            $camera = Camera::where('id','=',$signup->camera_id)->first();
            $library = null;
        }
        else {
            $signuptype = null;
        }
        return view('admin.signups.forms.edit', compact('signup','libraries','signuptype','formtitle', 'counties','cameras','camera','library'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $signup = Signup::findOrFail($id);
        $signup->update($request->except('camera_id'));
        if($request->has('camera_id')) {
            DB::table('signups')
                ->where('id','=',$id)
                ->update([
                    'camera_id' => $request->get('camera_id')
                ]);
        }
        Session::flash('flash_message', 'Signup Updated');
        return redirect()->action('Admin\SignupsController@show', ['id' => $signup->id]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Signup::destroy($id);
        Session::flash('flash_message', 'Signup deleted!');
        return redirect()->action('Admin\SignupsController@index');
    }
    /**
     * Create Volunteer Record from Signup Form Submission
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateSingleVolunteer($id)
    {
        $s = Signup::find($id);
        $input['email'] = $s->email;

        $rules = array('email' => 'unique:users,email,unique:volunteers,email');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Session::flash('flash_message', 'Unable to activate. The email is not unique. A user already exists with the same email');
//            return redirect()->action('Admin\SignupsController@show', ['id' => $s->id]);
            return back();
        }
        else {
                $v = new Volunteer();
                $v->first_name = $s->first_name;
                $v->last_name = $s->last_name;
                $v->email = $s->email;
                $v->telephone = $s->telephone;
                $v->organization = $s->organization;
                $v->county = $s->county;
                $v->city = $s->city;
                $v->zip_code = $s->zip_code;
                $v->signup_id = $s->id;
                $v->acf_borrower_yn = $s->acf_borrower_yn;
                $v->acf_uploader_yn = $s->acf_uploader_yn;
                $v->created_at = Carbon::now();
                $v->updated_at = Carbon::now();
                $v->activation_date = Carbon::now();
                $v->save();

                $password = str_random(10);

                $u = new User();
                $u->fname = $v->first_name;
                $u->lname = $v->last_name;
                $u->email = $v->email;
                $u->password = bcrypt($password);
                $u->save();


                $user = User::find($u->id);
                $role = Role::where('name', '=', 'user')->firstOrFail();
                $user->assignRole($role);

                DB::table('volunteers')
                    ->where('id', '=', $v->id)
                    ->update([
                        'user_id' => $u->id,
                    ]);

                DB::table('signups')
                    ->where('id', '=', $s->id)
                    ->update([
                        'volunteer_yn' => 1,
                    ]);


                Session::flash('flash_message', 'Volunteer Created');
                return redirect()->action('Admin\SignupsController@index');
                //return redirect()->action('Admin\VolunteersController@show', ['id' => $v->id]);
            }
    }


    function is_any_null() {
        $params = func_get_args();
        foreach($params as $param) {
            if (is_null($param))
                return true;
        }

        return false;
    }

}
