<?php

namespace App\Http\Controllers\Api\v1;
use App\Camera;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CamerasDataController extends Controller
{
    public function getCameras()
    {
        $query = Camera::select([
            'make', 'model', 'make_model', 'trigger_speed', 'product_url', 'remarks', 'acceptable_yn', 'model_number'
        ]);
        $original_data = $query->get()->sortBy('make_model');
        $features = array();

        foreach ($original_data as $key => $value) {
            $features[] = array(
                'make' => $value['make'],
                'model' => $value['model'],
                'trigger_speed' => $value['trigger_speed'],
                'product_url' => $value['product_url'],
                'remarks' => $value['remarks'],
                'acceptable_yn' => $value['acceptable_yn'],
                'model_number' => $value['model_number'],
                'make_model' => $value['make_model']
            );
        };
        $response = array($features);

        return Response::json($response);
    }

    public function searchCameras(Request $request)
    {
        if ($request->has('q')) {
        	$q = $request->get('q');
        	$cams = Camera::where('make_model','like','%'.$q.'%')->limit(5)->get()->sortBy('make_model');
//            $cams = Camera::search($request->get('q'))->limit(5)->get()->sortBy('make_model');
            $cameras = [];
            foreach ($cams as $cam) {
                $cameras[] = ['id' => $cam->id, 'text' => $cam->make_model];
            }
            return Response::json($cameras);
        }
        else {
            $cams = Camera::all()->sortBy('make_model');
            $cameras = [];
            foreach ($cams as $cam) {
                $cameras[] = ['id' => $cam->id, 'text' => $cam->make_model];
            }
            return Response::json($cameras);
        }
        /*
        $term = trim($request->get('search'));
        $term = $request->get('search');
        if (empty($term)) {
                $cams = Camera::all()->sortBy('make_model');
            $cameras = [];
            foreach ($cams as $cam) {
                $cameras[] = ['id' => $cam->id, 'text' => $cam->make_model];
            }
            return Response::json($cameras);
        } else {
            $cams = Camera::where('make_model', 'like', '%' . $term . '%')->limit(5)->get()->sortBy('make_model');
            $cameras = [];
            foreach ($cams as $cam) {
                $cameras[] = ['id' => $cam->id, 'text' => $cam->make_model];
            }
            return Response::json($cameras);
        }
        */
    }
    public function searchTest(Request $request)
    {
    	$q = $request->get('q');
    	$cameras = Camera::where('make_model','like','%'.$q.'%')->get();
    	return Response::json($cameras);
    }
}