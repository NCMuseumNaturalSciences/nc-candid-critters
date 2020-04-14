<?php

namespace App\Http\Controllers\Api\v1;
use App\Mail\MapSelectionAdminNotification;
use App\Mail\SiteSelectionConfirmation;
use Validator;
use Response;
use App\MapSite;
use App\Library;
use App\SiteDescription;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Http\Controllers\Controller;
class MapDataController extends Controller
{
    /**
     * Return All Available Sites as GEOJSON
     */
    public function getAllSites() {

        $query = MapSite::select([
               'id','site_name','site_number','lat','lon','county','available_yn','land_cover','property_name'
            ]);

        $original_data = $query->get();
        $features = array();

        foreach ($original_data as $key => $value) {
            if($value['available_yn'] = 1)
            {
                $status = 'Available';
            }
            else {
                $status = "Not Available";
            }
            $features[] = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array((float)$value['lon'], (float)$value['lat'])
                ),
                'properties' => array(
                    'site_id' => $value['id'],
                    'site_number' => $value['site_number'],
                    'site_name' => $value['site_name'],
                    'status' => $status,
                    'county' => $value['county'],
                    'lat' => $value['lat'],
                    'lon' => $value['lon'],
                    'habitat' => $value['land_cover'],
                    'property_name' => $value['property_name']

                ),
            );
        };
        $response = array('type' => 'FeatureCollection', 'features' => $features);

        return Response::json($response);
    }
    /**
     * Return All Available Sites as GEOJSON
     */
    public function getAvailableSites()
    {
        $query = MapSite::where('available_yn','=',1)
        ->select([
            'id','site_name','site_number','lat','lon','county','available_yn','land_cover','property_name','infowindow_content'
            ]);
        $original_data = $query->get();
        $features = array();

        foreach ($original_data as $key => $value) {
            if($value['available_yn'] = 1)
            {
                $status = 'Available';
            }
            else {
                $status = "Not Available";
            }
            $features[] = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array((float)$value['lon'], (float)$value['lat'])
                ),
                'properties' => array(
                    'id' => $value['id'],
//                    'site_number' => $value['site_number'],
                    'site_name' => $value['site_name'],
//                    'status' => $status,
//                    'county' => $value['county'],
                    'lat' => $value['lat'],
                    'lon' => $value['lon'],
//                    'habitat' => $value['habitat'],
//                    'property_name' => $value['property_name'],
                    'infowindow_content' => $value['infowindow_content']
                ),
            );
        };
        $response = array('type' => 'FeatureCollection', 'features' => $features);

        return Response::json($response);
    }
    public function getMapSite($id)
    {
        $query = MapSite::where('id','=',$id)
        ->select([
            'id', 'site_name','site_number','lat','lon','status','county','available_yn','infowindow_content','land_cover','property_name'
        ]);
        $original_data = $query->get();
        $features = array();

        foreach ($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array((float)$value['lon'], (float)$value['lat'])
                ),
                'properties' => array(
                    'site_id' => $value['id'],
                    'lat' => $value['lat'],
                    'lon' => $value['lon'],
                    'site_number' => $value['site_number'],
                    'site_name' => $value['site_name'],
                    'status' => $value['status'],
                    'county' => $value['county'],
                    'habitat' => $value['land_cover'],
                    'property_name' => $value['property_name'],
                    'available_yn' => $value['available_yn'],
                    'infowindow_content' => $value['infowindow_content']
                ),
            );
        };
        $response = array('type' => 'FeatureCollection', 'features' => $features);

        return Response::json($response);
    }

    public function getSiteDescription($id)
    {
        $query = SiteDescription::where('id','=',$id)
            ->select([
                'id',
                'first_name',
                'last_name',
                'email',
                'county',
                'deployment_name',
                'acf_lat',
                'acf_long',
            ]);
        $original_data = $query->get();
        $features = array();

        foreach ($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array((float)$value['acf_long'], (float)$value['acf_lat'])
                ),
                'properties' => array(
                    'id' => $value['id'],
                    'first_name' => $value['first_name'],
                    'last_name' => $value['last_name'],
                    'email' => $value['email'],
                    'county' => $value['county'],
                    'deployment_name' => $value['deployment_name'],
                    'lat' => $value['acf_lat'],
                    'lon' => $value['acf_long'],
                ),
            );
        };
        $response = array('type' => 'FeatureCollection', 'features' => $features);

        return Response::json($response);
    }


    /**
     * Store Map Site Selection by User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeSelection(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else {
            $post = $request->all();
            $s = MapSite::find($post['id']);
            if($s)
            {
                $sd = new SiteDescription();
                $sd->deployment_name = $s->site_name;
                $sd->first_name = $s->first_name;
                $sd->last_name = $s->last_name;
                $sd->email = $s->email;
                $sd->acf_lat = $s->lat;
                $sd->acf_long = $s->lon;
                $sd->county = $s->county;
                $sd->property_name = $s->property_name;
                $sd->gsheet_src = $s->source_gsheet_name;
                $sd->map_site_id = $s->id;
                $sd->created_at = Carbon::now()->toDateString();
                $sd->updated_at = Carbon::now()->toDateString();
                $sd->date_submitted= Carbon::now()->toDateString();
                $sd->save();

                DB::table('map_sites')
                    ->where('id', $s->id)
                    ->update([
                        'available_yn' => 0,
                        'display_on_map_yn' => 0,
                        'status' => 'Unavailable'
                        ]);

                $results = $sd->id;

                $recipient = $sd->email;
                //$recipients = $sd->email;

                $recipients = [
                    ['email' => 'ben.norton@naturalsciences.org', 'name' => 'Ben Norton - NCMNS'],
                    ['email' => 'michaelnorton.ben@gmail.com', 'name' => 'Ben Norton - Gmail'],
                    ['email' => 'mbhendri@ncsu.edu', 'name' => 'Monica Lasky']
                ];
/*
                Mail::to($recipients)
                    ->send(new SiteSelectionConfirmation($sd));
*/
                return Response::json(array('success' => true, 'results' => $results));
            }
            else {
                return Response::json(array('success' => false, 'results' => ''));
            }
        }
    }

    /**
     * Get Libraries that are accepting volunteers as GeoJSON for Map
     */
    public function getLibraries() {

        $query = Library::select([
            'id','library_name','telephone','street_address','city','zip','county', 'region', 'lat', 'lon', 'name_address','partner_yn','accepting_volunteers_yn'
        ])->where('accepting_volunteers_yn','=',1);

        $original_data = $query->get();
        $features = array();

        foreach ($original_data as $key => $value) {
            $full_address = $value['street_address'] . " " . $value['city'] . ", NC " . $value['zip'];
            $features[] = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array((float)$value['lon'], (float)$value['lat'])
                ),
                'properties' => array(
                    'id' => $value['id'],
                    'library_name' => $value['library_name'],
                    'telephone' => $value['telephone'],
                    'address' => $full_address,
                    'street_address' => $value['street_address'],
                    'city' => $value['city'],
                    'zip' => $value['zip'],
                    'county' => $value['county'],
                    'region' => $value['region'],
                    'lat' => $value['lat'],
                    'lon' => $value['lon'],
                ),
            );
        };
        $response = array('type' => 'FeatureCollection', 'features' => $features);

        return Response::json($response);
    }
}
