<?php

namespace App\Http\Controllers\Admin;
use App\SiteDescription;
use App\Volunteer;
use App\Deployment;
use Excel;
use DB;
use App\Signup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
class ExportController extends Controller
{
    public function index()
    {
        return view('admin.exports.index');
    }


    public function exportTrainingAssignmentsByDate(Request $request)
    {
        $start = $request->get('start_date');
        $end = $request->get('end_date');

        if(!$start) {
            $start = Carbon::now();
        }
        if(!$end) {
            $end = Carbon::now();
        }
        $model = Signup::where('training_assigned_yn', '=', 1)
            ->where('training_assigned_timestamp', '>=', $end)
            ->where('training_assigned_timestamp', '<=', $start)
            ->get();
        Excel::create('selected_training_assignments', function($excel) use($model) {
            $excel->sheet('Data', function($sheet) use($model) {
                $sheet->fromArray($model, null, 'A1', true);
            });
        })->export('xlsx');
    }


    public function exportSignups()
    {
        $model = Signup::all();
        Excel::create('signups', function($excel) use($model) {
            $excel->sheet('Data', function($sheet) use($model) {
                $sheet->fromArray($model, null, 'A1', true);
            });
        })->export('xlsx');
    }
public function exportVolunteers()
    {
        $model = Volunteer::all();
        Excel::create('volunteers', function($excel) use($model) {
            $excel->sheet('Data', function($sheet) use($model) {
                $sheet->fromArray($model, null, 'A1', true);
            });
        })->export('xlsx');
    }
    public function exportSiteDescriptions()
    {
        $model = SiteDescription::all();
        Excel::create('site_descriptions', function($excel) use($model) {
            $excel->sheet('Data', function($sheet) use($model) {
                $sheet->fromArray($model, null, 'A1', true);
            });
        })->export('xlsx');
    }

	public function exportDeployments()
    {
        $model = Deployment::all();
        Excel::create('deployments', function($excel) use($model) {
            $excel->sheet('Data', function($sheet) use($model) {
                $sheet->fromArray($model, null, 'A1', true);
            });
        })->export('xlsx');
    }
    public function exportMasterInventory()
    {
        $model = DB::table('inventories')
            ->join('inventory_status','inventory_status.id','=','inventories.status_id')
            ->leftjoin('libraries','libraries.id','=','inventories.library_id')
            ->get();
        Excel::create('master_inventory', function($excel) use($model) {
            $excel->sheet('Data', function($sheet) use($model) {
                $sheet->fromArray($model, null, 'A1', true);
            });
        })->export('xlsx');
    }


    public function exportSelectedSites()
    {
//        SiteDescription::whereNotNull('map_site_id')->get();
        $model = SiteDescription::join('map_sites', 'site_descriptions.map_site_id','=','map_sites.id')
            ->select(
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
                'site_descriptions.acf_uploader_yn',
                'site_descriptions.acf_borrower_yn',
                'site_descriptions.outside_dogs_yn',
                'site_descriptions.outside_cats_yn',
                'site_descriptions.outside_chickens_yn',
                'site_descriptions.outside_horses_yn',
                'site_descriptions.outside_none_yn',
                'site_descriptions.deployment_name',
                'site_descriptions.map_site_id',
                'site_descriptions.date_submitted',
                'site_descriptions.deployment_yn',
                'site_descriptions.imported_yn',
                'map_sites.site_number',
                'map_sites.site_name',
                'map_sites.lat',
                'map_sites.long',
                'map_sites.land_cover',
                'map_sites.status',
                'map_sites.source_gsheet_name',
                'map_sites.display_on_map_yn',
                'map_sites.fall_site_yn',
                'map_sites.available_yn',
                'map_sites.infowindow_content'
            )
            ->get();
        Excel::create('selected_sites', function($excel) use($model) {
            $excel->sheet('Data', function($sheet) use($model) {
                $sheet->fromArray($model, null, 'A1', true);
            });
        })->export('xlsx');
    }
}
