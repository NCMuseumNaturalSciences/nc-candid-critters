<?php

namespace App\Http\Controllers\Api\v1;

use App\Signup;
use App\User;
use Carbon\Carbon;
use DB;
use Spatie\Permission\Models\Role;
use Validator;
use Response;
use App\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VolunteersDataController extends Controller
{
    public function activateVolunteers(Request $request)
    {
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
                $s = Signup::find($selected);
                $input['email'] = $s->email;
                $rules = array('email' => 'unique:users,email,unique:volunteers,email');
                $singleValidator = Validator::make($input, $rules);
                if ($singleValidator->fails()) {
                    // Go to next record
                } else {
                    // Create New Volunteer from Signup
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

                    // Add Volunteer to Data Array (for Testing)
                    $data[] = $v;

                    // Create User Account for Volunteer
                    $password = str_random(10);
                    $u = new User();
                    $u->fname = $v->first_name;
                    $u->lname = $v->last_name;
                    $u->email = $v->email;
                    $u->password = bcrypt($password);
                    $u->save();

                    // Add User Account to Data Array for Testing
                    $data[] = $u;

                    // Assign Role to User Account
                    $user = User::find($u->id);
                    $role = Role::where('name', '=', 'user')->firstOrFail();
                    $user->assignRole($role);

                    // Set Relationship between Volunteer and User Account
                    DB::table('volunteers')
                        ->where('id', '=', $v->id)
                        ->update([
                            'user_id' => $u->id,
                        ]);

                    // Set Volunteer Declaration Boolean
                    DB::table('signups')
                        ->where('id', '=', $s->id)
                        ->update([
                            'volunteer_yn' => 1,
                        ]);

                };
            }
            $response = array($data);
            return Response::json($response);
//            return Response::json(array('success' => true));
        }
    }

    /**
     * Toggle Koozie Form Sent Field using Volunteer Array
     * Datatable Control
     */
    public function toggleKoozieFormSent(Request $request)
    {
        $volunteers = array();
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $data = array();
            $volunteers = $request->get('selected');
            foreach ($volunteers as $selected) {
                $v = Volunteer::find($selected);
                if($v->koozie_form_sent_yn == '0') {
                    $v->update([
                            'koozie_form_sent_yn' => '1',
                            'updated_at' => Carbon::Now()
                        ]);
                }
                else {
                    $v->update([
                        'koozie_form_sent_yn' => '0',
                        'updated_at' => Carbon::Now()
                    ]);
                }
                $data[] = $v;

            };
            $response = array($data);
//            return Response::json($response);
            return Response::json(array('success' => true));
        }
    }
    public function toggleKoozieSent(Request $request)
    {
        $volunteers = array();
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $data = array();
            $volunteers = $request->get('selected');
            foreach ($volunteers as $selected) {
                $v = Volunteer::find($selected);
                if ($v->koozie_yn == '0') {
                    $v->update([
                        'koozie_yn' => '1',
                        'updated_at' => Carbon::Now()
                    ]);
                } else {
                    $v->update([
                        'koozie_yn' => '0',
                        'updated_at' => Carbon::Now()
                    ]);
                }
                $data[] = $v;
            };
            return Response::json(array('success' => true));
        }
    }
    public function toggleTshirtFormSent(Request $request)
    {
        $volunteers = array();
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $data = array();
            $volunteers = $request->get('selected');
            foreach ($volunteers as $selected) {
                $v = Volunteer::find($selected);
                if($v->tshirt_form_sent_yn == '0') {
                    $v->update([
                        'tshirt_form_sent_yn' => '1',
                        'updated_at' => Carbon::Now()
                    ]);
                }
                else {
                    $v->update([
                        'tshirt_form_sent_yn' => '0',
                        'updated_at' => Carbon::Now()
                    ]);
                }
            };
            return Response::json(array('success' => true));
        }
    }
    public function toggleTshirtSent(Request $request)
    {
        $volunteers = array();
        $validator = Validator::make($request->all(), [
            'selected' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $data = array();
            $volunteers = $request->get('selected');
            foreach ($volunteers as $selected) {
                $v = Volunteer::find($selected);
                if($v->tshirt_sent_yn == '0') {
                    $v->update([
                        'tshirt_sent_yn' => '1',
                        'updated_at' => Carbon::Now()
                    ]);
                }
                else {
                    $v->update([
                        'tshirt_sent_yn' => '0',
                        'updated_at' => Carbon::Now()
                    ]);
                }
            };
            return Response::json(array('success' => true));
        }
    }

    public function searchVolunteers(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return Response::json([]);
        }
        try {
            $statusCode = 200;
            $vols = Volunteer::whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$term}%"])->limit(5)->get();
            $volunteers = [];
            foreach ($vols as $v) {
                $name =  $v->first_name . ' ' . $v->last_name;
                $volunteers[] = ['id' => $v->id, 'text' => $name];
            }
        }
        catch (Exception $e) {
            $statusCode = 400;
        }
        finally {
            return Response::json($volunteers, $statusCode);
        }
    }
}
