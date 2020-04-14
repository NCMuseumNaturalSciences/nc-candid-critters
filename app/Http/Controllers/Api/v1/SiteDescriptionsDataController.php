<?php

namespace App\Http\Controllers\Api\v1;
use App\Volunteer;
use Carbon\Carbon;
use DB;
use Validator;
use Response;
use App\SiteDescription;
use App\Deployment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteDescriptionsDataController extends Controller
{
    public function getDeploymentsCreated()
    {
        $sd = SiteDescription::where('deployment_yn','=',1)->get();
        $query = DB::table('site_descriptions')->join('deployments','site_descriptions.id','=','deployments.site_description_id')
            ->select([
                'site_descriptions.id as sd_id',
                'site_descriptions.first_name',
                'site_descriptions.last_name',
                'site_descriptions.email',
                'site_descriptions.emammal_user_id',
                'site_descriptions.delivery_method',
                'site_descriptions.mailing_address_sd',
                'site_descriptions.mailing_address_stamps',
                'site_descriptions.county',
                'site_descriptions.site_type',
                'site_descriptions.school_property_yn',
                'site_descriptions.camera_facing',
                'site_descriptions.property_type',
                'site_descriptions.property_name',
                'site_descriptions.fenced_yn',
                'site_descriptions.hunting_yn',
                'site_descriptions.hunting_details',
                'site_descriptions.purposeful_feeding_yn',
                'site_descriptions.accidental_food_yn',
                'site_descriptions.outside_pets_yn',
                'site_descriptions.camera_id',
                'site_descriptions.created_at',
                'site_descriptions.updated_at',
                'site_descriptions.user_latitude',
                'site_descriptions.user_longitude',
                'site_descriptions.acf_uploader_yn',
                'site_descriptions.acf_borrower_yn',
                'site_descriptions.outside_dogs_yn',
                'site_descriptions.outside_cats_yn',
                'site_descriptions.outside_chickens_yn',
                'site_descriptions.outside_horses_yn',
                'site_descriptions.outside_none_yn',
                'site_descriptions.deployment_name',
                'site_descriptions.map_site_id',
                'site_descriptions.deployment_yn',
                'site_descriptions.imported_yn',
                'site_descriptions.gsheet_src',
                'site_descriptions.acf_lat',
                'site_descriptions.acf_long',
                'site_descriptions.camera_import_text',
                'site_descriptions.emammal_created_yn',
                'site_descriptions.status'])
            ->get();
        $data = $query->toArray();
        $response = array($data);
        return Response::json($response);
    }
    public function createDeployments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selected' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $selected = $request->get('selected');

            foreach ($selected as $s) {
                $d = SiteDescription::find($s);
                $deployCheck = Deployment::where('site_description_id' ,'=',$s)->first();
                if (is_null($deployCheck)) {
                    $deploy = new Deployment;
                    $deploy->deployment_lat = $d->acf_lat;
                    $deploy->deployment_long = $d->acf_long;
                    $deploy->site_description_id = $d->id;
                    $deploy->deployment_name = $d->deployment_name;
                    $deploy->acf_uploader_yn = $d->acf_uploader_yn;
                    $deploy->acf_borrower_yn = $d->acf_borrower_yn;
                    $deploy->created_at = Carbon::now()->toDateString();
                    $deploy->updated_at = Carbon::now()->toDateString();
                    $deploy->save();

                    DB::table('site_descriptions')
                        ->where('id', '=', $s)
                        ->update([
                            'deployment_yn' => '1',
                        ]);

                    // If volunteer record exists, set relationship
                    $volunteer = Volunteer::where('email', '=', $d->email)->first();
                    if ($volunteer) {
                        $newdeploy = Deployment::find($deploy->id);
                        $newdeploy->volunteer_id = $volunteer->id;
                        $newdeploy->save();
                    }
                }
            };
            return Response::json(array('success' => true));
        }
    }
    public function toggleEmammalBoolean(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selected' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        else {
            $data = array();
            $selected = $request->get('selected');

            foreach ($selected as $s) {
                $sd = SiteDescription::find($s);
                $emammalYN = $sd->emammal_created_yn;
                if($emammalYN == 1) {
                    DB::table('site_descriptions')
                        ->where('id', '=', $s)
                        ->update([
                            'emammal_created_yn' => '0',
                            'updated_at' => Carbon::now()->toDateString()
                        ]);
                    $data[] = array(
                        $s => 0
                    );
                }
                elseif ($emammalYN == 0) {
                    DB::table('site_descriptions')
                        ->where('id', '=', $s)
                        ->update([
                            'emammal_created_yn' => '1',
                            'updated_at' => Carbon::now()->toDateString()
                        ]);
                    $data[] = array(
                        $s => 1
                    );
                }
                else {
                    //Do Nothing
                }
            };
            $response = array($data);
            return Response::json($response);
            //return Response::json(array('success' => true));
        }
    }
}