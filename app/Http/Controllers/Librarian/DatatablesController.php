<?php

namespace App\Http\Controllers\Librarian;
use App\StaticArray;
use DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DatatablesController extends Controller
{
    /**
     * All Reservations Datatable
     */
    public function getReservations()
    {
        $models = DB::table('reservations')
            ->join('volunteers','reservations.volunteer_id','=','volunteers.id')
            ->join('inventories','reservations.inventory_id','=','inventories.id')
            ->select([
                DB::raw("reservations.id as reservation_id"),
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
                'inventories.barcode'
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
            ->editColumn('librarian_email', function ($model) {
                return \Html::mailto($model->librarian_email, $model->librarian_name);
            })
            ->filterColumn('volunteer_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($model) {
                if($model->closed_yn == 1) {
                    return '<a class="btn btn-sm btn-primary" href="'.StaticArray::$constants['baseliburl'].'/reservations/'.$model->reservation_id.'/show">View</a>';
                }
                else {
                    return '<a class="btn btn-sm btn-primary" href="'.StaticArray::$constants['baseliburl'].'/reservations/'.$model->reservation_id.'/show">View</a>' .
                        '<a class="btn btn-sm btn-warning" href="'.StaticArray::$constants['baseliburl'].'/reservations/'.$model->reservation_id.'/edit">Update/Close</a>' .
                        view('utils.destroy',array('url' => '/librarian/reservations', 'id' => $model->reservation_id))->render();
                }
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
            ->select([
                DB::raw("reservations.id as reservation_id"),
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
                'inventories.barcode'
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
            ->editColumn('librarian_email', function ($model) {
                return \Html::mailto($model->librarian_email, $model->librarian_name);
            })
            ->filterColumn('volunteer_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-sm btn-primary" href="'.StaticArray::$constants['baseliburl'].'/reservations/'.$model->reservation_id.'/show">View</a>' .
                    '<a class="btn btn-sm btn-warning" href="'.StaticArray::$constants['baseliburl'].'/reservations/'.$model->reservation_id.'/edit">Update/Close</a>' .
                view('utils.destroy',array('url' => '/librarian/reservations', 'id' => $model->reservation_id))->render();
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
            ->select([
                DB::raw("reservations.id as reservation_id"),
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
                'inventories.barcode'
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
            ->editColumn('librarian_email', function ($model) {
                return \Html::mailto($model->librarian_email, $model->librarian_name);
            })
            ->filterColumn('volunteer_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) like ?", ["%{$keyword}%"]);
            })
            ->addColumn('action', function ($model) {
                return '<a class="btn btn-sm btn-primary" href="'.StaticArray::$constants['baseliburl'].'/reservations/'.$model->reservation_id.'/show">View</a>';
            })
            ->make(true);
    }
    /**
     * Filter Library Inventory
     */
    public function getInventory(Request $request)
    {
        $models = DB::table('inventories')
            ->join('inventory_status','inventories.status_id','=','inventory_status.id')
            ->select([
                'inventories.id',
                'inventories.barcode',
                'inventories.nccc_id',
                DB::raw('inventories.camera_present_yn as cp_yn'),
                DB::raw('inventories.plastic_box_yn as pb_yn'),
                DB::raw('inventories.lock_yn as l_yn'),
                DB::raw('inventories.item_list_yn as il_yn'),
                DB::raw('inventories.batteries_yn as b_yn'),
                DB::raw('inventories.sd_cards_yn as sd_yn'),
                DB::raw('inventories.camera_working_yn as cw_yn'),
                'inventories.status_id',
                DB::raw("inventory_status.status_name as status_name")
            ]);
        return Datatables::of($models)
            ->editColumn('cp_yn', function ($model) {
                if($model->cp_yn == 1) {
                    return '<i class="fa fa-check text-success"></i>';
                }
                else {
                    return '<i class="fa fa-times text-danger"></i>';
                }
            })
            ->editColumn('pb_yn', function ($model) {
                if($model->pb_yn == 1) {
                    return '<i class="fa fa-check text-success"></i>';
                }
                else {
                    return '<i class="fa fa-times text-danger"></i>';
                }
            })
            ->editColumn('l_yn', function ($model) {
                if($model->l_yn == 1) {
                    return '<i class="fa fa-check text-success"></i>';
                }
                else {
                    return '<i class="fa fa-times text-danger"></i>';
                }
            })
            ->editColumn('il_yn', function ($model) {
                if($model->il_yn == 1) {
                    return '<i class="fa fa-check text-success"></i>';
                }
                else {
                    return '<i class="fa fa-times text-danger"></i>';
                }
            })
            ->editColumn('b_yn', function ($model) {
                if($model->b_yn == 1) {
                    return '<i class="fa fa-check text-success"></i>';
                }
                else {
                    return '<i class="fa fa-times text-danger"></i>';
                }
            })
            ->editColumn('sd_yn', function ($model) {
                if($model->sd_yn == 1) {
                    return '<i class="fa fa-check text-success"></i>';
                }
                else {
                    return '<i class="fa fa-times text-danger"></i>';
                }
            })
            ->editColumn('cw_yn', function ($model) {
                if($model->cw_yn == 1) {
                    return '<i class="fa fa-check text-success"></i>';
                }
                else {
                    return '<i class="fa fa-times text-danger"></i>';
                }
            })
            ->make(true);
    }
}
