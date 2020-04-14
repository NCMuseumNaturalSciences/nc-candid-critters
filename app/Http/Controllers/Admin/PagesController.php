<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Camera;
use App\Deployment;
use App\Inventory;
use App\Library;
use App\MapSite;
use App\Reservation;
use App\Signup;
use App\SiteDescription;
use App\Volunteer;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $stats = array(
            'reservations-all' => Reservation::count(),
            'reservations-open' => Reservation::getOpen()->count(),
            'reservations-closed' => Reservation::getClosed()->count(),
            'volunteers' => Volunteer::count(),
            'signups' => Signup::count(),
            'site-descriptions' => SiteDescription::count(),
            'deployments' => Deployment::count(),
            'cameras' => Camera::count(),
            'libraries' => Library::count(),
            'map-sites' => MapSite::count(),
            'inventory' => Inventory::count(),
            'inventory-missing' => DB::table('inventories')
                ->join('inventory_status','inventories.status_id','=','inventory_status.id')
                ->where('inventory_status.status_name','=','Missing')
                ->count(),
            'inventory-reserved' => DB::table('inventories')
                ->join('inventory_status','inventories.status_id','=','inventory_status.id')
                ->where('inventory_status.status_name','=','Reserved')
                ->count(),
        );
        return view('admin.dashboards.administrator', compact('user', 'stats'));
    }
    public function getApiInformation()
    {
        $user = Auth::user();
        return view('admin.apis.show',compact('user'));
    }
}
