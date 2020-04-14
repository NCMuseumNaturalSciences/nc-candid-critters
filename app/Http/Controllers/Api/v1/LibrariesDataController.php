<?php

namespace App\Http\Controllers\Api\v1;
use Response;
use App\Library;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LibrariesDataController extends Controller
{
    public function getLibraries()
    {
        $query = Library::select([
            'library_name',
            'telephone',
            'contact_first_name',
            'contact_last_name',
            'contact_email',
            'street_address',
            'city',
            'zip',
            'county',
            'region',
            'partner_yn',
            'remarks',
            'accepting_volunteers_yn'
        ]);
        $original_data = $query->get();
        $features = array();

        foreach ($original_data as $key => $value) {
            $features[] = array(
                'library_name' => $value['library_name'],
                'telephone' => $value['telephone'],
                'contact_first_name' => $value['contact_first_name'],
                'contact_last_name' => $value['contact_last_name'],
                'contact_email' => $value['contact_email'],
                'street_address' => $value['street_address'],
                'city' => $value['city'],
                'zip' => $value['zip'],
                'county' => $value['county'],
                'region' => $value['region'],
                'partner_yn' => $value['partner_yn'],
                'remarks' => $value['remarks'],
                'accepting_volunteers_yn' => $value['accepting_volunteers_yn'],
            );
        };
        $response = array($features);

        return Response::json($response);
    }

    public function searchLibraries(Request $request)
    {
        $term = trim($request->q);
        if (empty($term)) {
            return Response::json([]);
        }
        try {
            $statusCode = 200;
            $libs = Library::where('library_name', 'like', '%'.$term.'%')->limit(5)->get();
            $libraries = [];
                foreach ($libs as $lib) {
                    $libraries[] = ['id' => $lib->id, 'text' => $lib->name_address];
                }
        }
        catch (Exception $e) {
            $statusCode = 400;
        }
        finally {
            return Response::json($libraries, $statusCode);
        }
    }
}
