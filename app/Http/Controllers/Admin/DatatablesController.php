<?php

namespace App\Http\Controllers\Admin;
use App\SiteDescription;
use App\User;
use Spatie\Permission\Models\Role;
use Session;
use App\Volunteer;
use App\Signup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StaticArray;
use DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class DatatablesController extends Controller
{
    /**
     * Datatable: View All Cameras
     * Parameters: none
     */
    public function getCameras()
    {
        $models = DB::table('cameras')
            ->select(['cameras.id',
                'cameras.make',
                'cameras.model'
            ]);
        return Datatables::of($models)
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/cameras/'.$model->id.'/show">View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/cameras/'.$model->id.'/edit">Update</a>' .
                    view('utils.destroy',array('url' => '/admin/cameras', 'id' => $model->id))->render();
    //                view('utils.delete',array('url' => URL::route('admin.cameras.destroy',$model->id)));
            })
            ->make(true);
    }

    /**
     * Datatable: View All Libraries
     *
     *
     */
    public function getLibraries()
    {
        $models = DB::table('libraries')
            ->select(['libraries.id',
                'libraries.county',
                'libraries.library_name',
                'libraries.region',
                'libraries.telephone'
            ]);
        return Datatables::of($models)
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/libraries/'.$model->id.'/show">View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/libraries/'.$model->id.'/edit">Update</a>' .
                    view('utils.destroy',array('url' => '/admin/libraries', 'id' => $model->id))->render();
            })
            ->make(true);
    }

    /** SIGNUPS ------------------------------------------------------- **/
    /**
     * Datatable: View ALl Signups
     * @param Request $request
     * @return
     * @throws \Exception
     */
    public function getSignups(Request $request)
    {
        $models = DB::table('signups')
            ->leftjoin('volunteers','signups.id','=','volunteers.signup_id')
            ->select([
                DB::raw("signups.id as id"),
                DB::raw("volunteers.id as volunteer_id"),
                DB::raw("CONCAT(signups.first_name, ' ', signups.last_name) as pname"),
                'signups.first_name',
                'signups.last_name',
                'signups.email',
                'signups.acf_uploader_yn',
                'signups.acf_borrower_yn',
                'signups.training_status_id',
                'volunteers.signup_id',
                'signups.created_at as sdate'
            ]);
        return DataTables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('training_status')) {
                    if($request->get('training_status')) {
                        $query->where('training_status_id', '=', $request->get('training_status'));
                    }
                }
                if ($request->has('uploader_type')) {
                    $uptype = $request->get('uploader_type');
                    if($uptype == 1) {
                        $query->where('signups.acf_uploader_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('signups.acf_uploader_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('signups.acf_uploader_yn', [0, 1]);
                    }
                }
            }, true)
            ->addColumn('training', function ($model) {
                if ($model->training_status_id == 1) {
                    return 'Unassigned';
                } else if ($model->training_status_id == 2) {
                    return 'Assigned';
                } else if ($model->training_status_id == 3) {
                    return 'Completed';
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('volunteer', function ($model) {
                if($model->signup_id) {
                    return 'Volunteer';
                }
                else {
                    return 'Not A Volunteer';
                }
            })
            ->addColumn('utype', function ($model) {
                if ($model->acf_uploader_yn == 1) {
                    return "Uploader";
                }
                else if ($model->acf_uploader_yn == 0) {
                    return "Non-uploader";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('btype', function ($model) {
                if ($model->acf_borrower_yn == 1) {
                    return "Borrower";
                }
                else if ($model->acf_borrower_yn == 0) {
                    return "BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->editColumn('sdate', function($model){
                $submitDate = new Carbon($model->sdate);
                return $submitDate->format('m/d/Y');
            })
            ->editColumn('email', function ($model) {
                return \Html::mailto($model->email, $model->email);
            })
            ->addColumn('action', function ($model) {
                if($model->signup_id) {
                    return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/signups/'.$model->id.'/show"> View</a>'.
                        view('utils.destroy',array('url' => '/admin/signups', 'id' => $model->id))->render();
                }
                else {
                    return  '<a class="btn btn-xs btn-dt-row btn-custom-success" href="' . StaticArray::$constants['baseadminurl'] . '/signups/' . $model->id . '/activate"> Activate</a>' .
                            '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/signups/' . $model->id . '/show"> View</a>' .
                            view('utils.destroy', array('url' => '/admin/signups', 'id' => $model->id))->render();

                }
            })
            ->filterColumn('pname', function($query, $keyword) {
                $query->whereRaw("CONCAT(signups.first_name, ' ', signups.last_name) like ?", ["%{$keyword}%"]);
            })
            ->make(true);
    }

    /**
     * Removed 20190910
     * Signups Database - Volunteer Unactivated
     * @param Request $request
     * @return
     * @throws \Exception
     */
    public function getUnactivatedSignups(Request $request)
    {
        $vsids = Volunteer::pluck('signup_id')->all();
        $models = Signup::whereNotIn('id', $vsids)
            ->select([
                DB::raw("signups.id as id"),
                DB::raw("CONCAT(signups.first_name, ' ', signups.last_name) as pname"),
                'signups.first_name',
                'signups.last_name',
                'signups.email',
                'signups.acf_uploader_yn',
                'signups.acf_borrower_yn',
                'signups.training_status_id',
                'signups.created_at as sdate'
            ]);
        return DataTables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('training_status')) {
                    if($request->get('training_status')) {
                        $query->where('training_status_id', '=', $request->get('training_status'));
                    }
                }
                if ($request->has('uploader_type')) {
                    $uptype = $request->get('uploader_type');
                    if($uptype == 1) {
                        $query->where('signups.acf_uploader_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('signups.acf_uploader_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('signups.acf_uploader_yn', [0, 1]);
                    }
                }
            }, true)
            ->addColumn('training', function ($model) {
                if ($model->training_status_id == 1) {
                    return 'Unassigned';
                } else if ($model->training_status_id == 2) {
                    return 'Assigned';
                } else if ($model->training_status_id == 3) {
                    return 'Completed';
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('utype', function ($model) {
                if ($model->acf_uploader_yn == 1) {
                    return "Uploader";
                }
                else if ($model->acf_uploader_yn == 0) {
                    return "Non-uploader";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('btype', function ($model) {
                if ($model->acf_borrower_yn == 1) {
                    return "Borrower";
                }
                else if ($model->acf_borrower_yn == 0) {
                    return "BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->editColumn('sdate', function($model){
                $submitDate = new Carbon($model->sdate);
                return $submitDate->format('m/d/Y');
            })
            ->editColumn('email', function ($model) {
                return \Html::mailto($model->email, $model->email);
            })
            ->addColumn('action', function ($model) {
                    return  '<a class="btn btn-xs btn-dt-row btn-custom-success" href="' . StaticArray::$constants['baseadminurl'] . '/signups/' . $model->id . '/activate"> Activate</a>' .
                        '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/signups/' . $model->id . '/show"> View</a>' .
                        view('utils.destroy', array('url' => '/admin/signups', 'id' => $model->id))->render();
            })
            ->filterColumn('pname', function($query, $keyword) {
                $query->whereRaw("CONCAT(signups.first_name, ' ', signups.last_name) like ?", ["%{$keyword}%"]);
            })
            ->make(true);
    }

    /**
     * Removed 20190910
     * Signups Database - Volunteer Unactivated
     * @param Request $request
     * @return
     * @throws \Exception
     */
    public function getActivatedSignups(Request $request)
    {
        $models = Signup::join('volunteers','signups.id','=','volunteers.signup_id')
            ->select([
                DB::raw("signups.id as id"),
                DB::raw("volunteers.id as volunteer_id"),
                DB::raw("CONCAT(signups.first_name, ' ', signups.last_name) as pname"),
                'signups.first_name',
                'signups.last_name',
                'signups.email',
                'signups.acf_uploader_yn',
                'signups.acf_borrower_yn',
                'signups.training_status_id',
                'volunteers.signup_id',
                'signups.created_at as sdate'
            ]);
        return DataTables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('training_status')) {
                    if($request->get('training_status')) {
                        $query->where('training_status_id', '=', $request->get('training_status'));
                    }
                }
                if ($request->has('uploader_type')) {
                    $uptype = $request->get('uploader_type');
                    if($uptype == 1) {
                        $query->where('signups.acf_uploader_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('signups.acf_uploader_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('signups.acf_uploader_yn', [0, 1]);
                    }
                }
            }, true)
            ->addColumn('training', function ($model) {
                if ($model->training_status_id == 1) {
                    return 'Unassigned';
                } else if ($model->training_status_id == 2) {
                    return 'Assigned';
                } else if ($model->training_status_id == 3) {
                    return 'Completed';
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('utype', function ($model) {
                if ($model->acf_uploader_yn == 1) {
                    return "Uploader";
                }
                else if ($model->acf_uploader_yn == 0) {
                    return "Non-uploader";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('btype', function ($model) {
                if ($model->acf_borrower_yn == 1) {
                    return "Borrower";
                }
                else if ($model->acf_borrower_yn == 0) {
                    return "BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->editColumn('sdate', function($model){
                $submitDate = new Carbon($model->sdate);
                return $submitDate->format('m/d/Y');
            })
            ->editColumn('email', function ($model) {
                return \Html::mailto($model->email, $model->email);
            })
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/signups/' . $model->id . '/show"> View</a>' .
                    view('utils.destroy', array('url' => '/admin/signups', 'id' => $model->id))->render();
            })
            ->filterColumn('pname', function($query, $keyword) {
                $query->whereRaw("CONCAT(signups.first_name, ' ', signups.last_name) like ?", ["%{$keyword}%"]);
            })
            ->make(true);
    }




    /** SITE DESCRIPTIONS ------------------------------------------------------- **/
    /**
     * Site Description Datatable
     */
    public function getSiteDescriptions(Request $request)
    {
        $models = DB::table('site_descriptions')
            ->leftJoin('deployments','deployments.site_description_id','=','site_descriptions.id')
            ->select([
                'site_descriptions.id',
                'first_name',
                'last_name',
                DB::raw("CONCAT(site_descriptions.first_name, ' ', site_descriptions.last_name) as full_name"),
                'email',
                'site_descriptions.deployment_name',
                'map_site_id',
                'site_descriptions.acf_uploader_yn',
                'site_descriptions.acf_borrower_yn',
                DB::raw("site_descriptions.created_at as submission_date"),
                'deployment_yn',
//                'emammal_created_yn',
                'acf_lat',
                'acf_long',
                'site_descriptions.county',
                DB::raw("COUNT(deployments.site_description_id) as deployment_count"),
            ])
            ->groupBy('site_descriptions.id',
                'first_name',
                'last_name',
                'full_name',
                'email',
                'site_descriptions.deployment_name',
                'map_site_id',
                'site_descriptions.acf_uploader_yn',
                'site_descriptions.acf_borrower_yn',
                'deployment_yn',
                'submission_date',
                'acf_lat',
                'acf_long',
                'site_descriptions.county')
            ->whereNull('map_site_id');

        return Datatables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('uploader_type')) {
                    $uptype = $request->get('uploader_type');
                    if($uptype == 1) {
                        $query->where('site_descriptions.acf_uploader_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('site_descriptions.acf_uploader_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('site_descriptions.acf_uploader_yn', [0, 1]);
                    }
                }
                if ($request->has('borrower_type')) {
                    $uptype = $request->get('borrower_type');
                    if($uptype == 1) {
                        $query->where('site_descriptions.acf_borrower_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('site_descriptions.acf_borrower_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('site_descriptions.acf_borrower_yn', [0, 1]);
                    }
                }
                if ($request->has('deployment_yn')) {
                    $uptype = $request->get('deployment_yn');
                    if($uptype == 1) {
                        $query->where('site_descriptions.deployment_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('site_descriptions.deployment_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('site_descriptions.deployment_yn', [0, 1]);
                    }
                }
            }, true)
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('utype', function ($model) {
                if ($model->acf_uploader_yn == 1) {
                    return "Uploader";
                }
                else if ($model->acf_uploader_yn == 0) {
                    return "Non-uploader";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('btype', function ($model) {
                if ($model->acf_borrower_yn == 1) {
                    return "Borrower";
                }
                else if ($model->acf_borrower_yn == 0) {
                    return "BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('deployment_status', function ($model) {
                if ($model->deployment_yn == 0) {
                    return 'No';
                } else {
                    return 'Yes';
                }
            })
            ->editColumn('submission_date', function ($model) {
                $submissionDate = new Carbon($model->submission_date);
                return $submissionDate->format('m/d/Y');
            })
            ->addColumn('action', function ($model) {
                if($model->deployment_yn == 0) {
                    if ($model->acf_uploader_yn == 0) {
                        return '<a class="btn btn-xs btn-dt-row btn-custom-success" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/activate">Create</a>' .
                            '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/show"> View</a>' .
                            '<a class="btn btn-xs btn-dt-row btn-custom-update" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/edit"> Update</a>' .
                            view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                    }
                    else {
                        return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/show"> View</a>' .
                            '<a class="btn btn-xs btn-dt-row btn-custom-update" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/edit"> Update</a>' .
                            view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                    }
                }
                else {
                    return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/show"> View</a>' .
                        view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                }
            })
        ->make(true);
    }
    /**
     * Site Description Datatable - Uploaders
     */
    public function getUploaderSiteDescriptions(Request $request)
    {
        $models = DB::table('site_descriptions')
            ->leftJoin('deployments','deployments.site_description_id','=','site_descriptions.id')
            ->select([
                'site_descriptions.id',
                'first_name',
                'last_name',
                DB::raw("CONCAT(site_descriptions.first_name, ' ', site_descriptions.last_name) as full_name"),
                'email',
                'site_descriptions.deployment_name',
                'map_site_id',
                'site_descriptions.acf_borrower_yn',
                DB::raw("site_descriptions.created_at as submission_date"),
                'deployment_yn',
//                'emammal_created_yn',
                'acf_lat',
                'acf_long',
                'site_descriptions.county'
            ])
            ->groupBy('site_descriptions.id',
                'first_name',
                'last_name',
                'full_name',
                'email',
                'site_descriptions.deployment_name',
                'map_site_id',
                'site_descriptions.acf_borrower_yn',
                'deployment_yn',
                'submission_date',
                'acf_lat',
                'acf_long',
                'site_descriptions.county')
            ->whereNull('map_site_id')
            ->where('site_descriptions.acf_uploader_yn','=',1);

        return Datatables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('borrower_type')) {
                    $uptype = $request->get('borrower_type');
                    if ($uptype == 1) {
                        $query->where('site_descriptions.acf_borrower_yn', '=', 1);
                    } else if ($uptype == 2) {
                        $query->where('site_descriptions.acf_borrower_yn', '=', 0);
                    } else {
                        $query->whereIn('site_descriptions.acf_borrower_yn', [0, 1]);
                    }
                }
                if ($request->has('deployment_yn')) {
                    $dc = $request->get('deployment_yn');
                    if ($dc == 1) {
                        $query->where('site_descriptions.deployment_yn', '=', 1);
                    } else if ($dc == 2)
                        $query->where('site_descriptions.deployment_yn', '=', 0);
                    else {
                        $query->whereIn('site_descriptions.deployment_yn', [0, 1]);
                    }
                }
            }, true)
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$keyword}%"]);
            })
            ->editColumn('submission_date', function ($model) {
                $submissionDate = new Carbon($model->submission_date);
                return $submissionDate->format('m/d/Y');
            })
            ->addColumn('btype', function ($model) {
                if ($model->acf_borrower_yn == 1) {
                    return "Borrower";
                }
                else if ($model->acf_borrower_yn == 0) {
                    return "BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('deployment_status', function ($model) {
                if ($model->deployment_yn == 0) {
                    return 'No';
                } else {
                    return 'Yes';
                }
            })
            ->addColumn('action', function ($model) {
                if($model->deployment_yn == 0) {
                        return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/show"> View</a>' .
                        '<a class="btn btn-xs btn-dt-row btn-custom-update" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/edit"> Update</a>' .
                        view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                }
                else {
                    return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/show"> View</a>' .
                        view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                }
            })
            ->make(true);
    }

    /**
     * Site Description Datatable - Non-uploaders
     */
    public function getNonUploaderSiteDescriptions(Request $request)
    {
        $models = DB::table('site_descriptions')
            ->leftJoin('deployments','deployments.site_description_id','=','site_descriptions.id')
            ->select([
                'site_descriptions.id',
                'first_name',
                'last_name',
                DB::raw("CONCAT(site_descriptions.first_name, ' ', site_descriptions.last_name) as full_name"),
                'email',
                'site_descriptions.deployment_name',
                'map_site_id',
                'site_descriptions.acf_uploader_yn',
                'site_descriptions.acf_borrower_yn',
                'site_descriptions.deployment_yn',
                DB::raw("site_descriptions.created_at as submission_date"),
                'emammal_created_yn',
                'acf_lat',
                'acf_long',
                'site_descriptions.county',
                DB::raw("COUNT(deployments.site_description_id) as deployment_count"),
            ])
            ->groupBy('site_descriptions.id',
                'first_name',
                'last_name',
                'full_name',
                'email',
                'site_descriptions.deployment_name',
                'map_site_id',
                'site_descriptions.acf_uploader_yn',
                'site_descriptions.acf_borrower_yn',
                'site_descriptions.deployment_yn',
                'submission_date',
                'acf_lat',
                'acf_long',
                'site_descriptions.county')
            ->whereNull('map_site_id')
            ->where('site_descriptions.acf_uploader_yn','=',0);

        return Datatables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('borrower_type')) {
                    $uptype = $request->get('borrower_type');
                    if($uptype == 1) {
                        $query->where('site_descriptions.acf_borrower_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('site_descriptions.acf_borrower_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('site_descriptions.acf_borrower_yn', [0, 1]);
                    }
                }
                if ($request->has('deployment_yn')) {
                    $dply = $request->get('deployment_yn');
                    if($dply == 1) {
                        $query->where('deployment_yn', '=', 1);
                    }
                    else if ($dply == 2) {
                        $query->where('deployment_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('deployment_yn', [0, 1]);
                    }
                }
            }, true)
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$keyword}%"]);
            })
            ->editColumn('submission_date', function ($model) {
                $submissionDate = new Carbon($model->submission_date);
                return $submissionDate->format('m/d/Y');
            })
            ->addColumn('btype', function ($model) {
                if ($model->acf_borrower_yn == 1) {
                    return "Borrower";
                }
                else if ($model->acf_borrower_yn == 0) {
                    return "BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('deployment_status', function ($model) {
                if ($model->deployment_yn == 0) {
                    return 'No';
                } else {
                    return 'Yes';
                }
            })
            ->addColumn('emammal_yn', function ($model) {
                if ($model->emammal_created_yn == 0) {
                    return 'No';
                } else {
                    return 'Yes';
                }
            })
            ->addColumn('action', function ($model) {
                if($model->deployment_yn == 0) {
                    return '<a class="btn btn-xs btn-dt-row btn-custom-success" href="'.StaticArray::$constants['baseadminurl'].'/site-descriptions/'.$model->id.'/activate">Create</a>'.
                        '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/show"> View</a>' .
                        '<a class="btn btn-xs btn-dt-row btn-custom-update" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/edit"> Update</a>' .
                        view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                }
                else {
                    return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/site-descriptions/' . $model->id . '/show"> View</a>' .
                        view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                }
            })
            ->make(true);
    }



    /** MAP SITES ------------------------------------------------------- **/
    /**
     * Map Sites Datatable
     */
    public function getMapSitesData()
    {
        $models = DB::table('map_sites')
            ->select(['map_sites.id',
                'map_sites.lat',
                'map_sites.lon',
                'map_sites.site_name',
                'map_sites.site_number',
                'map_sites.status'
            ]);
        return Datatables::of($models)
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/map-sites/'.$model->id.'/show">View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/map-sites/'.$model->id.'/edit">Update</a>' .
                    view('utils.destroy',array('url' => '/admin/map-sites', 'id' => $model->id))->render();
            })
            ->make(true);
    }

    /**
     * Map Selections Datatable Data
     */
    public function getMapSelections(Request $request)
    {
        $models = DB::table('site_descriptions')
            ->select([
                'site_descriptions.id',
                'site_descriptions.first_name',
                'site_descriptions.last_name',
                DB::raw("CONCAT(site_descriptions.first_name, ' ', site_descriptions.last_name) as full_name"),
                'site_descriptions.deployment_name as deployment_name',
                'site_descriptions.created_at',
                'site_descriptions.acf_lat',
                'site_descriptions.acf_long',
                'site_descriptions.deployment_yn',
                'site_descriptions.email',
                'site_descriptions.county',
                'site_descriptions.acf_uploader_yn',
                'site_descriptions.acf_borrower_yn'
            ])
            ->whereNotNull('map_site_id');

        return Datatables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('uploader_type')) {
                    $uptype = $request->get('uploader_type');
                    if($uptype == 1) {
                        $query->where('acf_uploader_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('acf_uploader_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('acf_uploader_yn', [0, 1]);
                    }
                }
                if ($request->has('deployment_yn')) {
                    $dply = $request->get('deployment_yn');
                    if($dply == 1) {
                        $query->where('deployment_yn', '=', 1);
                    }
                    else if ($dply == 2) {
                        $query->where('deployment_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('deployment_yn', [0, 1]);
                    }
                }
            }, true)
            ->addColumn('deployment_status', function ($model) {
                if ($model->deployment_yn == 0) {
                    return 'No';
                } else {
                    return 'Yes';
                }
            })
            ->editColumn('created_at', function($model){
                $submitDate = new Carbon($model->created_at);
                return $submitDate->format('m/d/Y');
            })
            ->editColumn('email', function ($model) {
                if($model->email) {
                    return \Html::mailto($model->email, $model->email);
                }
                else {
                    return "Not Found";
                }
            })
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(site_descriptions.first_name, ' ', site_descriptions.last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('deployment_status', function ($model) {
                if ($model->deployment_yn == 0) {
                    return 'No';
                } else {
                    return 'Yes';
                }
            })
            ->addColumn('action', function ($model) {
                if($model->deployment_yn == 0) {
                    return '<a class="btn btn-xs btn-dt-row btn-custom-success" href="'.StaticArray::$constants['baseadminurl'].'/site-descriptions/'.$model->id.'/activate"> Create</a>'.
                        '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/map-selections/' . $model->id . '/show"> View</a>' .
                        '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/map-selections/'.$model->id.'/edit">Update</a>' .
                        view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                }
                else {
                    return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/map-selections/' . $model->id . '/show"> View</a>' .
                        '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/map-selections/'.$model->id.'/edit">Update</a>' .
                        view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
                }
            })
            ->make(true);
    }
    public function getMapSelectionsByCounty(Request $request, $county)
{
    $models = DB::table('site_descriptions')
        ->select([
            'site_descriptions.id',
            'site_descriptions.first_name',
            'site_descriptions.last_name',
            DB::raw("CONCAT(site_descriptions.first_name, ' ', site_descriptions.last_name) as full_name"),
            'site_descriptions.deployment_name as deployment_name',
            'site_descriptions.created_at',
            'site_descriptions.acf_lat',
            'site_descriptions.acf_long',
            'site_descriptions.deployment_yn',
            'site_descriptions.email',
            'site_descriptions.county',
            'site_descriptions.acf_uploader_yn',
            'site_descriptions.acf_borrower_yn'
        ])
        ->whereNotNull('map_site_id')
        ->where('county','=',$county);

    return Datatables::of($models)
        ->filter(function ($query) use ($request) {
            if ($request->has('uploader_type')) {
                $uptype = $request->get('uploader_type');
                if($uptype == 1) {
                    $query->where('acf_uploader_yn', '=', 1);
                }
                else if ($uptype == 2) {
                    $query->where('acf_uploader_yn', '=', 0);
                }
                else {
                    $query->whereIn('acf_uploader_yn', [0, 1]);
                }
            }
            if ($request->has('borrower_type')) {
                $uptype = $request->get('borrower_type');
                if($uptype == 1) {
                    $query->where('acf_borrower_yn', '=', 1);
                }
                else if ($uptype == 2) {
                    $query->where('acf_borrower_yn', '=', 0);
                }
                else {
                    $query->whereIn('acf_borrower_yn', [0, 1]);
                }
            }
        }, true)
        ->addColumn('deployment_status', function ($model) {
            if ($model->deployment_yn == 0) {
                return 'No';
            } else {
                return 'Yes';
            }
        })
        ->editColumn('created_at', function($model){
            $submitDate = new Carbon($model->created_at);
            return $submitDate->format('m/d/Y');
        })
        ->editColumn('email', function ($model) {
            if($model->email) {
                return \Html::mailto($model->email, $model->email);
            }
            else {
                return "Not Found";
            }
        })
        ->filterColumn('full_name', function($query, $keyword) {
            $query->whereRaw("CONCAT(site_descriptions.first_name, ' ', site_descriptions.last_name) like ?", ["%{$keyword}%"]);
        })
        ->addColumn('deployment_status', function ($model) {
            if ($model->deployment_yn == 0) {
                return 'No';
            } else {
                return 'Yes';
            }
        })
        ->addColumn('action', function ($model) {
            if($model->deployment_yn == 0) {
                return '<a class="btn btn-xs btn-dt-row btn-custom-success" href="'.StaticArray::$constants['baseadminurl'].'/site-descriptions/'.$model->id.'/activate"> Create</a>'.
                    '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/map-selections/' . $model->id . '/show"> View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/map-selections/'.$model->id.'/edit">Update</a>' .
                    view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
            }
            else {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/map-selections/' . $model->id . '/show"> View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/map-selections/'.$model->id.'/edit">Update</a>' .
                    view('utils.destroy', array('url' => '/admin/site-descriptions', 'id' => $model->id))->render();
            }
        })
        ->make(true);
}
    public function countyFilter(Request $request)
    {
        if($request->has('county')) {
            $sites = SiteDescription::where('county',$request->get('county'))->get();
            return response()->json(['data' => $sites]);
        } else {
            $sites = SiteDescription::get();
            return response()->json(['data' => $sites]);
        }
    }

    /** DEPLOYMENTS ------------------------------------------------------- **/
    /**
     * Deployments Datatable
     */
    public function getDeployments(Request $request)
    {
        $models = DB::table('deployments')
            ->leftjoin('volunteers', 'deployments.volunteer_id','=','volunteers.id')
            ->join('site_descriptions','deployments.site_description_id','=','site_descriptions.id')
            ->select([
                DB::raw("deployments.id as id"),
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as vname"),
                'deployments.deployment_name as deployment_name',
                'volunteers.email as volunteer_email',
                'site_descriptions.acf_lat',
                'site_descriptions.acf_long',
                'deployment_lat',
                'deployment_long',
                'site_description_id',
                'deployments.created_at',
                'deployments.acf_uploader_yn',
                'deployments.upload_status as upload_status',
                'site_descriptions.id as site_description_id'

            ]);
        return Datatables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('status')) {
                    if($request->get('status')) {
                        $query->where('deployments.upload_status', '=', $request->get('status'));
                    }
                }
            }, true)
            ->filterColumn('vname', function($query, $keyword) {
                $query->whereRaw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) like ?", ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function ($model) {
                $submissionDate = new Carbon($model->created_at);
                return $submissionDate->format('m/d/Y');
            })
            ->editColumn('volunteer_email', function ($model) {
                if($model->volunteer_email) {
                    return \Html::mailto($model->volunteer_email, $model->volunteer_email);
                }
                else {
                    return null;
                }
            })
            ->addColumn('utype', function ($model) {
                if ($model->acf_uploader_yn == 1) {
                    return "Uploader";
                }
                else if ($model->acf_uploader_yn == 0) {
                    return "Non-uploader";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/deployments/'.$model->id.'/show"> View</a>'.
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/deployments/'.$model->id.'/edit">Update</a>' .
                    view('utils.destroy',array('url' => '/admin/deployments', 'id' => $model->id))->render();
            })
            ->make(true);
    }

    /** VOLUNTEERS ------------------------------------------------------- **/
    /**
     ** Volunteers Datatable
     */
    public function getVolunteers(Request $request)
    {
        $models = DB::table('volunteers')
            ->leftjoin('library_volunteer_assignments','volunteers.id','=','library_volunteer_assignments.volunteer_id')
            ->select([
                'volunteers.id',
                'first_name',
                'last_name',
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as full_name"),
                'email',
                'acf_uploader_yn',
                'acf_borrower_yn',
                'activation_date',
                'volunteers.created_at',
                'library_volunteer_assignments.volunteer_id as assignmentId'

            ])
            ->groupBy('volunteers.id','first_name','last_name','email',
                'acf_uploader_yn',
                'acf_borrower_yn',
                'activation_date',
                'library_volunteer_assignments.volunteer_id'
            );
        return Datatables::of($models)
            ->filter(function ($query) use ($request) {
                if ($request->has('uploader_type')) {
                    $uptype = $request->get('uploader_type');
                    if($uptype == 1) {
                        $query->where('acf_uploader_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('acf_uploader_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('acf_uploader_yn', [0, 1]);
                    }
                }
                if ($request->has('borrower_type')) {
                    $uptype = $request->get('borrower_type');
                    if($uptype == 1) {
                        $query->where('acf_borrower_yn', '=', 1);
                    }
                    else if ($uptype == 2) {
                        $query->where('acf_borrower_yn', '=', 0);
                    }
                    else {
                        $query->whereIn('acf_borrower_yn', [0, 1]);
                    }
                }
                if ($request->has('library_yn')) {
                    $libyn = $request->get('library_yn');
                    if($libyn == 1) {
                        $query->whereNotNUll('library_volunteer_assignments.volunteer_id');
                    }
                    else if ($libyn == 2) {
                        $query->whereNull('library_volunteer_assignments.volunteer_id');
                    }
                    else {
                        $query->whereNotNull('volunteers.id');
                    }
                }
            }, true)


            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('assignment_yn', function ($model) {
                if ($model->assignmentId) {
                    return "Yes";
                }
                else {
                    return "No";
                }
            })
            ->editColumn('created_at', function ($model) {
                $submissionDate = new Carbon($model->created_at);
                return $submissionDate->format('m/d/Y');
            })
            ->addColumn('utype', function ($model) {
                if ($model->acf_uploader_yn == 1) {
                    return "Uploader";
                }
                else if ($model->acf_uploader_yn == 0) {
                    return "Non-uploader";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('btype', function ($model) {
                if ($model->acf_borrower_yn == 1) {
                    return "Borrower";
                }
                else if ($model->acf_borrower_yn == 0) {
                    return "BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->editColumn('activation_date', function ($model) {
                $submissionDate = new Carbon($model->activation_date);
                return $submissionDate->format('m/d/Y');
            })
            ->editColumn('email', function ($model) {
                return \Html::mailto($model->email, $model->email);
            })
            ->rawColumns(['action','email'])
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/volunteers/'.$model->id.'/show">View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="' . StaticArray::$constants['baseadminurl'] . '/volunteers/' . $model->id . '/edit"> Update</a>';
            })
            ->make(true);
    }

    /**
     * Get Assigned Volunteers
     */
    public function getLibraryVolunteers($libraryId)
    {
        $models = DB::table('volunteers')
            ->join('library_volunteer_assignments', 'volunteers.id', '=', 'library_volunteer_assignments.volunteer_id')
            ->join('libraries', 'library_volunteer_assignments.library_id', '=', 'libraries.id')
            ->select([
                'volunteers.id',
                'volunteers.first_name',
                'volunteers.last_name',
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as full_name"),
                'volunteers.email as email',
                'volunteers.acf_uploader_yn',
                'volunteers.acf_borrower_yn',
                'libraries.id',
                'libraries.library_name',
                'library_volunteer_assignments.created_at as assignment_date'
            ])
            ->where('libraries.id','=',$libraryId);

        return Datatables::of($models)
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('volunteer_type', function ($model) {
                if ($model->acf_uploader_yn == 1 && $model->acf_borrower_yn == 1) {
                    return "Uploader Borrower";
                }
                else if ($model->acf_uploader_yn == 1 && $model->acf_borrower_yn == 0) {
                    return "Uploader BYO";
                }
                else if ($model->acf_uploader_yn == 0 && $model->acf_borrower_yn == 1) {
                    return "Non-uploader Borrower";
                }
                else if ($model->acf_uploader_yn == 0 && $model->acf_borrower_yn == 0) {
                    return "Non-uploader BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->editColumn('assignment_date', function ($model) {
                $submissionDate = new Carbon($model->assignment_date);
                return $submissionDate->format('m/d/Y');
            })
            ->editColumn('email', function ($model) {
                return \Html::mailto($model->email, $model->email);
            })
            ->rawColumns(['action','email'])
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/volunteers/'.$model->id.'/show">View</a>';
            })
            ->make(true);
    }

    /**
     * Volunteer Rewards Datatable
     * @return mixed
     * @throws \Exception
     */
    public function getVolunteerRewards(Request $request)
    {
        $models = DB::table('volunteers')
            ->leftjoin('deployments','deployments.volunteer_id','=','volunteers.id')
            ->select([
                DB::RAW('volunteers.id as id'),                
                'volunteers.email',
                'volunteers.first_name',
                'volunteers.last_name',
                'volunteers.koozie_yn',
                'volunteers.koozie_form_sent_yn',
                'volunteers.tshirt_form_sent_yn',
                'volunteers.tshirt_sent_yn',
                DB::RAW('COUNT(deployments.volunteer_id) as deployment_count')
            ])
            ->groupBy('volunteers.id',
                'volunteers.email',
                'volunteers.first_name',
                'volunteers.last_name',
                'volunteers.koozie_yn',
                'volunteers.koozie_form_sent_yn',
                'volunteers.tshirt_form_sent_yn',
                'volunteers.tshirt_sent_yn'
            )
            ->havingRaw('COUNT(deployments.volunteer_id) > 0');
        return Datatables::of($models)
        	->filter(function ($query) use ($request) {
        	    /*
        		if (!empty($request->get('koozie_form_sent_yn'))) {
	                $kf = $request->get('koozie_form_sent_yn');
                    if ($kf == 1) {
                        $query->where('koozie_form_sent_yn', '=', '1');
                    } else if ($kf == 2) {
                        $query->where('koozie_form_sent_yn', '=', '0');
                    } else {
                        $query->whereIn('koozie_form_sent_yn', [0, 1]);
                    }
                }
        	    */
                if ($request->has('tshirt_yn')) {
                    $tf = $request->get('tshirt_yn');
                    if ($tf == 'Yes') {
                        $query->where('tshirt_form_sent_yn', '=', 1);
                    } else if ($tf == 'No') {
                        $query->where('tshirt_form_sent_yn', '=', '0');
                    } else {
                        $query->whereIn('tshirt_form_sent_yn', [0, 1]);
                    }
                }
                if ($request->has('koozie_yn')) {
                    $kz = $request->get('koozie_yn');
                    if($kz == 'Yes') {
                        $query->where('koozie_form_sent_yn', '=', 1);
                    }
                    else if ($kz == 'No') {
                        $query->where('koozie_form_sent_yn', '=', '0');
                    }
                    else {
                        $query->whereIn('koozie_form_sent_yn', [0, 1]);
                    }
                }
/*
                if ($request->has('volunteer_name')) {
                    $name = $request->get('volunteer_name');
                    $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$name}%"])
                        ->orWhereRaw("email like ?", ["%{$name}%"]);
                }
*/
            }, true)
            ->addColumn('volunteer_fullname', function($model) {
            	$fname = $model->first_name;
            	$lname = $model->last_name;
            	$fullname = $fname . " " . $lname;
            	return $fullname;
            })
            ->addColumn('koozie_form', function ($model) {
                if ($model->koozie_form_sent_yn == 1) {
                    return "Yes";
                }
                else if ($model->koozie_form_sent_yn == 0) {
                    return "No";
                }
               else {
                    return 'Error';
                }
            })
            ->addColumn('koozie', function ($model) {
                if ($model->koozie_yn == 1) {
                    return "Yes";
                }
                else if ($model->koozie_yn == 0) {
                    return "No";
                }
                else {
                    return 'Error';
                }
            })
            ->addColumn('tshirt_form', function ($model) {
                if ($model->tshirt_form_sent_yn == 1) {
                    return "Yes";
                }
                else if ($model->tshirt_form_sent_yn == 0) {
                    return "No";
                }
                else {
                    return 'Error';
                }
            })

            ->addColumn('tshirt', function ($model) {
                if ($model->tshirt_sent_yn == 1) {
                    return "Yes";
                }
                else if ($model->tshirt_sent_yn == 0) {
                    return "No";
                }
                else {
                    return 'Error';
                }
            })

            ->editColumn('email', function ($model) {
                return \Html::mailto($model->email, $model->email);
            })
            ->rawColumns(['action','email'])
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/volunteers/'.$model->id.'/show">View</a>';
            })
            ->make(true);
    }





    /** Reservations */
    /**
     * All Reservations Datatable
     */
    public function getReservations()
    {
        $models = DB::table('reservations')
            ->join('volunteers','reservations.volunteer_id','=','volunteers.id')
            ->join('inventories','reservations.inventory_id','=','inventories.id')
            ->join('inventory_status','inventories.status_id','=','inventory_status.id')
            ->join('libraries','inventories.library_id','=','libraries.id')
            ->select([
                DB::raw("reservations.id as id"),
                'reservations.open_date',
                'reservations.close_date',
                'reservations.created_at',
                'volunteers.first_name',
                'volunteers.last_name',
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as volunteer_name"),
                DB::raw("volunteers.telephone as volunteer_phone"),
                DB::raw("volunteers.email as volunteer_email"),
                'reservations.librarian_name',
                'reservations.librarian_phone',
                'reservations.librarian_email',
                'reservations.closed_yn',
                'inventories.nccc_id',
                'inventories.barcode',
                'inventory_status.status_name',
                'libraries.library_name'
            ]);
        return Datatables::of($models)
            ->editColumn('open_date', function ($model) {
                $checkoutDate = new Carbon($model->open_date);
                return $checkoutDate->format('m/d/Y');
            })
            ->editColumn('close_date', function ($model) {
                if($model->closed_yn == 1) {
                    $checkinDate = new Carbon($model->close_date);
                    return $checkinDate->format('m/d/Y');
                }
                else {
                    return null;
                }
            })
            ->editColumn('volunteer_email', function ($model) {
                return \Html::mailto($model->volunteer_email, $model->volunteer_email);
            })
            ->filterColumn('volunteer_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($model) {
                    return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/reservations/'.$model->id.'/show">View</a>' .
                        '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/reservations/'.$model->id.'/edit">Update/Close</a>' .
                        view('utils.destroy',array('url' => '/admin/reservations', 'id' => $model->id))->render();
            })
            ->make(true);
    }
    /**
     * Open Reservations Datatable
     */
    public function getOpenReservations()
    {
        $models = DB::table('reservations')
            ->join('volunteers','reservations.volunteer_id','=','volunteers.id')
            ->join('inventories','reservations.inventory_id','=','inventories.id')
            ->join('inventory_status','inventories.status_id','=','inventory_status.id')
            ->join('libraries','inventories.library_id','=','libraries.id')
            ->select([
                DB::raw("reservations.id as id"),
                'reservations.open_date',
                'reservations.close_date',
                'reservations.created_at',
                'volunteers.first_name',
                'volunteers.last_name',
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as volunteer_name"),
                DB::raw("volunteers.telephone as volunteer_phone"),
                DB::raw("volunteers.email as volunteer_email"),
                'reservations.librarian_name',
                'reservations.librarian_phone',
                'reservations.librarian_email',
                'reservations.closed_yn',
                'inventories.nccc_id',
                'inventories.barcode',
                'inventory_status.status_name',
                'libraries.library_name'
            ])
            ->where('reservations.closed_yn','=',0);
        return Datatables::of($models)
            ->editColumn('open_date', function ($model) {
                $checkoutDate = new Carbon($model->open_date);
                return $checkoutDate->format('m/d/Y');
            })
            ->editColumn('close_date', function ($model) {
                if($model->closed_yn == 1) {
                    $checkinDate = new Carbon($model->close_date);
                    return $checkinDate->format('m/d/Y');
                }
                else {
                    return null;
                }
            })
            ->editColumn('volunteer_email', function ($model) {
                return \Html::mailto($model->volunteer_email, $model->volunteer_email);
            })
            ->filterColumn('volunteer_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/reservations/'.$model->id.'/show">View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/reservations/'.$model->id.'/edit">Update/Close</a>' .
                    view('utils.destroy',array('url' => '/admin/reservations', 'id' => $model->id))->render();
            })
            ->make(true);
    }
    /**
     * Closed Reservations Datatable
     */
    public function getClosedReservations()
    {
        $models = DB::table('reservations')
            ->join('volunteers','reservations.volunteer_id','=','volunteers.id')
            ->join('inventories','reservations.inventory_id','=','inventories.id')
            ->join('inventory_status','inventories.status_id','=','inventory_status.id')
            ->join('libraries','inventories.library_id','=','libraries.id')
            ->select([
                DB::raw("reservations.id as id"),
                'reservations.open_date',
                'reservations.close_date',
                'reservations.created_at',
                'volunteers.first_name',
                'volunteers.last_name',
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as volunteer_name"),
                DB::raw("volunteers.telephone as volunteer_phone"),
                DB::raw("volunteers.email as volunteer_email"),
                'reservations.librarian_name',
                'reservations.librarian_phone',
                'reservations.librarian_email',
                'reservations.closed_yn',
                'inventories.nccc_id',
                'inventories.barcode',
                'inventory_status.status_name',
                'libraries.library_name'
            ])
            ->where('reservations.closed_yn','=',1);
        return Datatables::of($models)
            ->editColumn('open_date', function ($model) {
                $checkoutDate = new Carbon($model->open_date);
                return $checkoutDate->format('m/d/Y');
            })
            ->editColumn('close_date', function ($model) {
                if($model->closed_yn == 1) {
                    $checkinDate = new Carbon($model->close_date);
                    return $checkinDate->format('m/d/Y');
                }
                else {
                    return null;
                }
            })
            ->editColumn('volunteer_email', function ($model) {
                return \Html::mailto($model->volunteer_email, $model->volunteer_email);
            })
            ->filterColumn('volunteer_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/reservations/'.$model->id.'/show">View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="'.StaticArray::$constants['baseadminurl'].'/reservations/'.$model->id.'/edit">Update/Close</a>' .
                    view('utils.destroy',array('url' => '/admin/reservations', 'id' => $model->id))->render();
            })
            ->make(true);
    }

    /**
     * Inventory Datatable
     */
    public function getInventoriesData(Request $request)
    {
        $models = DB::table('inventories')
            ->join('inventory_status','inventory_status.id','=','inventories.status_id')
            ->leftjoin('libraries','libraries.id','=','inventories.library_id')
            ->select([
                'inventories.id',
                'inventories.barcode',
                'inventories.nccc_id',
                'libraries.library_name',
                'inventories.status_id',
                'inventory_status.status_name',
                'inventory_status.status_code'
            ]);
        return Datatables::of($models)
            ->filter(function($query) use ($request) {
               if($request->has('status_code')) {
                   $status = $request->get('status_code');
                   if($status) {
                       $query->where('inventory_status.status_code', '=', $status);
                   }
                   else {
                       $query->whereNotNull('inventory_status.status_code');
                   }
               }
            }, true)
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-custom-view" href="' . StaticArray::$constants['baseadminurl'] . '/inventories/' . $model->id . '/show">View</a>' .
                    view('utils.destroy',array('url' => '/admin/inventories', 'id' => $model->id))->render();
            })
        ->make(true);
    }

    /**
     * Hybrids
     */
    /**
     * Get All Assigned Volunteers with their Assigned Library
     *
     */
    public function librariesVolunteers()
    {
        return view('admin.hybrids.libraries-volunteers');
    }
    public function getLibrariesVolunteers()
    {
        $models = DB::table('volunteers')
            ->join('library_volunteer_assignments', 'volunteers.id', '=', 'library_volunteer_assignments.volunteer_id')
            ->join('libraries', 'library_volunteer_assignments.library_id', '=', 'libraries.id')
            ->select([
                DB::raw('volunteers.id as volunteer_id'),
                'volunteers.first_name',
                'volunteers.last_name',
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as full_name"),
                'volunteers.email as email',
                'volunteers.acf_uploader_yn',
                'volunteers.acf_borrower_yn',
                DB::raw('libraries.id as library_id'),
                'libraries.library_name',
            ]);

        return Datatables::of($models)
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('volunteer_type', function ($model) {
                if ($model->acf_uploader_yn == 1 && $model->acf_borrower_yn == 1) {
                    return "Uploader Borrower";
                }
                else if ($model->acf_uploader_yn == 1 && $model->acf_borrower_yn == 0) {
                    return "Uploader BYO";
                }
                else if ($model->acf_uploader_yn == 0 && $model->acf_borrower_yn == 1) {
                    return "Non-uploader Borrower";
                }
                else if ($model->acf_uploader_yn == 0 && $model->acf_borrower_yn == 0) {
                    return "Non-uploader BYO";
                }
                else {
                    return 'Error';
                }
            })
            ->editColumn('email', function ($model) {
                return \Html::mailto($model->email, $model->email);
            })
            ->rawColumns(['action','email'])
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/volunteers/'.$model->volunteer_id.'/show"><i class="fas fa-user-alt"></i> View Volunteer</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/libraries/'.$model->library_id.'/show"><i class="fas fa-university"></i> View Library</a>';
            })
            ->make(true);
    }

    /**
     * Get All Library User Accounts
     *
     */
    public function librariesUsers()
    {
        return view('admin.hybrids.library-users');
    }
    public function getLibrariesUsers()
    {
        $models = DB::table('users')
            ->join('library_assign_user', 'users.id', '=', 'library_assign_user.user_id')
            ->join('libraries','library_assign_user.library_id','=','libraries.id')
            ->select([
                DB::raw('users.id as user_id'),
                DB::raw("CONCAT(users.fname, ' ', users.lname) as full_name"),
                'users.email',
                DB::raw('libraries.id as library_id'),
                'libraries.library_name'
            ]);
        return Datatables::of($models)
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(users.fname, ' ', user.lname) like ?", ["%{$keyword}%"]);
            })
            ->editColumn('email', function ($model) {
                return \Html::mailto($model->email, $model->email);
            })
            ->rawColumns(['action','email'])
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/users/'.$model->user_id.'/show"><ion-icon name="contact"></ion-icon> View User</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-primary" href="'.StaticArray::$constants['baseadminurl'].'/libraries/'.$model->library_id.'/show"><i class="fas fa-university"></i> View Library</a>';
            })
            ->make(true);
    }


    public function getLibraryReservations($status_id,$library_id)
    {
        $models = DB::table('reservations')
            ->join('volunteers', 'reservations.volunteer_id', '=', 'volunteers.id')
            ->join('inventories', 'reservations.inventory_id', '=', 'inventories.id')
            ->join('libraries', 'inventories.library_id', '=', 'libraries.id')
            ->join('inventory_status', 'inventories.status_id', '=', 'inventory_status.id')
            ->select([
                DB::raw("reservations.id as id"),
                'reservations.open_date',
                'reservations.close_date',
                'reservations.created_at',
                'reservations.status_id',
                'volunteers.first_name',
                'volunteers.last_name',
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as volunteer_name"),
                DB::raw("volunteers.telephone as volunteer_phone"),
                DB::raw("volunteers.email as volunteer_email"),
                'reservations.librarian_name',
                'reservations.librarian_phone',
                'reservations.librarian_email',
                'reservations.closed_yn',
                'inventories.nccc_id',
                'inventories.barcode',
                'inventory_status.status_name',
                'libraries.library_name'
            ])
            ->where('reservations.closed_yn', '=', $status_id);
        return Datatables::of($models)
            ->editColumn('open_date', function ($model) {
                $checkoutDate = new Carbon($model->open_date);
                return $checkoutDate->format('m/d/Y');
            })
            ->editColumn('close_date', function ($model) {
                if ($model->closed_yn == 1) {
                    $checkinDate = new Carbon($model->close_date);
                    return $checkinDate->format('m/d/Y');
                } else {
                    return null;
                }
            })
            ->editColumn('volunteer_email', function ($model) {
                return \Html::mailto($model->volunteer_email, $model->volunteer_email);
            })
            ->editColumn('librarian_email', function ($model) {
                return \Html::mailto($model->librarian_email, $model->librarian_name);
            })
            ->filterColumn('volunteer_name', function ($query, $keyword) {
                $query->whereRaw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-xs btn-dt-row btn-primary" href="' . StaticArray::$constants['baseadminurl'] . '/reservations/' . $model->id . '/show">View</a>' .
                    '<a class="btn btn-xs btn-dt-row btn-custom-update" href="' . StaticArray::$constants['baseadminurl'] . '/reservations/' . $model->id . '/edit">Update/Close</a>' .
                    view('utils.destroy', array('url' => '/admin/reservation', 'id' => $model->id))->render();
            })
            ->make(true);
    }

    /**
     * Create Volunteer Record from Signup Form Submission
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateDatatableVolunteer($id)
    {
        $s = Signup::find($id);
        $vCheck = DB::table('volunteers')
            ->where('email','=', $s->email)
            ->first();
        $uCheck = DB::table('users')
            ->where('email','=', $s->email)
            ->first();
        if (!isset($vCheck, $uCheck)) {
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
                ->where('id','=',$v->id)
                ->update([
                    'user_id' => $u->id,
                ]);

            DB::table('signups')
                ->where('id','=', $s->id)
                ->update([
                    'volunteer_yn' => 1,
                ]);


            Session::flash('flash_message', 'Volunteer Created');
            return redirect()->action('Admin\VolunteersController@show', ['id' => $v->id]);
        }
        else if (isset($vCheck) && !isset($uCheck)) {
            Session::flash('flash_message', 'Volunteer Already Exists');
            return redirect()->action('Admin\SignupsController@show', ['id' => $s->id]);
        }
        else if (!isset($vCheck) && isset($uCheck)) {
            Session::flash('flash_message', 'User Already Exists');
            return redirect()->action('Admin\SignupsController@show', ['id' => $s->id]);
        }
        else {
            Session::flash('flash_message', 'Error during Volunteer and User Email Check');
            return redirect()->action('Admin\SignupsController@show', ['id' => $s->id]);
        }
    }






}