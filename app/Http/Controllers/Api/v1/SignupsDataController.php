<?php

namespace App\Http\Controllers\Api\v1;
use App\User;
use App\Volunteer;
use Carbon\Carbon;
use DB;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Input\Input;
use Validator;
use App\Signup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
class SignupsDataController extends Controller
{
    public function getSignups()
    {
        $query = Signup::select([
            'id',
            'first_name',
            'last_name',
            'email',
            'volunteer_yn',
            'training_assigned_yn',
            'training_completed_yn',
        ]);
        $original_data = $query->get();
        $data = array();

        foreach ($original_data as $key => $value) {
            $data[] = array(
                'id' => $value['id'],
                'first_name' => $value['first_name'],
                'last_name' => $value['last_name'],
                'email' => $value['email'],
                'volunteer_yn' => $value['volunteer_yn'],
                'training_assigned_yn' => $value['training_assigned_yn'],
                'training_completed_yn' => $value['training_completed_yn']
            );
        };
        $response = array($data);
        return Response::json($response);
    }
    public function getTrainingUnassigned()
    {
        $query = Signup::where('training_assigned_yn','=',0)
            ->select([
            'id',
            DB::raw('CONCAT("first_name", "last_name","(",email,")") as text'),
            'first_name',
            'last_name',
            'email'
        ]);
        $original_data = $query->get();
        $data = array();

        foreach ($original_data as $key => $value) {
            $data[] = array(
                'id' => $value['id'],
                'text' => $value['text'],
            );
        };
        $response = array($data);
        return Response::json($response);
    }
    public function storeTrainingAssignments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'signups' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $signups = $request->get('signups');
            foreach($signups as $selected) {
                $signup = Signup::find($selected->id)->first();
                DB::table('signups')
                    ->where('id', $selected->id)
                    ->update(['training_assigned_yn' => 1]);
            };
            return Response::json(array('success' => true));
        }
    }

    /*
     * Assign Training to Signups in Bulk Via the Search Signups Datatable
     */
    public function assignTraining(Request $request)
    {
        $signups = array();
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $signups = $request->get('selected');
            //$signups = Input::all();
            foreach ($signups as $selected) {

                DB::table('signups')
                    ->where('id', '=', $selected)
                    ->update([
                        'training_status_id' => 2,
                        'training_assigned_timestamp' => Carbon::Now()
                        ]);
            };
            return Response::json(array('success' => true));
        }
    }
    public function completedTraining(Request $request)
    {
        $signups = array();
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $signups = $request->get('selected');
            //$signups = Input::all();
            foreach ($signups as $selected) {

                DB::table('signups')
                    ->where('id', '=', $selected)
                    ->update([
                        'training_status_id' => 3,
                        'training_completed_timestamp' => Carbon::Now()
                    ]);
            };
            return Response::json(array('success' => true));
        }
    }
    public function getActivatedSignups()
    {

    }
    public function activateVolunteers(Request $request)
    {
        $vsids = Volunteer::pluck('signup_id')->all();
        $signups = array();
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $data = array();
            $signups = $request->get('selected');

            foreach ($signups as $selected) {
                $s = Signup::whereNotIn('id', $vsids)->find($selected);
                $sv = Volunteer::where('signup_id', '=', $selected)->first();
                if (!$sv) {
                    $input['email'] = $s->email;
                    $rules = array('email' => 'unique:users,email,unique:volunteers,email');
                    $innerValidator = Validator::make($input, $rules);

                    if ($innerValidator->fails()) {
                        Session::flash('flash_message', 'Unable to activate. The email is not unique. A user already exists with the same email');
                        // return back();
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

                        $data[] = $v;

                        $password = str_random(10);

                        $u = new User();
                        $u->fname = $v->first_name;
                        $u->lname = $v->last_name;
                        $u->email = $v->email;
                        $u->password = bcrypt($password);
                        $u->save();
                        $data[] = $u;

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

                    };
                }
            }
            $response = array($data);
            //return Response::json($response);
            return Response::json(array('success' => true));

        }
    }
}
