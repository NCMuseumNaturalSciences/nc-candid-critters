<?php

namespace App\Http\Controllers\Admin;
use Session;
use App\Inventory;
use App\Library;
use App\Volunteer;
use Carbon\Carbon;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ReservationsController extends Controller
{

    /**
     * Show ALl Reservations
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $library = null;
        $statusStr = 'All';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('admin.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount','library'));
    }
    public function libraryAll($library_id)
    {
        $library = Library::where('id','=',$library_id)->first();
        $statusStr = 'All';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('admin.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount','library'));
    }
    /**
     * Show all Open Reservations
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function open()
    {
        $library = null;
        $statusStr = 'Open';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('admin.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount','library'));
    }
    public function libraryOpen($library_id)
    {
        $library = Library::where('id','=',$library_id)->first();
        $statusStr = 'Open';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('admin.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount','library'));
    }

    /**
     * Show all Closed Reservations
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function closed()
    {
        $library = null;
        $statusStr = 'Closed';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('admin.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount','library'));
    }
    public function libraryClosed($library_id)
    {
        $library = Library::where('id','=',$library_id)->first();
        $statusStr = 'Closed';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('admin.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount','library'));
    }
    /**
     * Create Blank Reservation
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //$libraries = Library::all();
        $volunteers = Volunteer::all();
        $lbids = DB::table('library_volunteer_assignments')->get()->pluck('library_id');
        $libraries = Library::whereIn('id',$lbids)->get();
        return view('admin.reservations.create', compact('libraries'));
    }

    /**
     * Store a new resource.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::table('reservations')->insert(array(
            'open_date' => $this->change_date_format($request->get('open_date')),
            'remarks' => $request->get('remarks'),
            'volunteer_id' => $request->get('volunteer_id'),
            'inventory_id' => $request->get('inventory_id'),
            'librarian_name' => $request->get('librarian_name'),
            'librarian_email' => $request->get('librarian_email'),
            'librarian_phone' => $request->get('librarian_phone'),
            'closed_yn' => 0,
            'status_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ));
        DB::table('inventories')
            ->where('id','=',$request->get('inventory_id'))
            ->update([
                'status_id' => 2,
                'updated_at' => Carbon::now()
            ]);
        DB::table('inventory_status_timestamps')
            ->insert([
                'inventory_id' => $request->get('inventory_id'),
                'inventory_status_id' => 2,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        Session::flash('flash_message', 'Created New Reservation!');
        return redirect()->action('Admin\ReservationsController@index');
    }

    /**
     * Show Reservation
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Edit Reservation
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $opendate = $reservation->open_date;
        if ($opendate) {
            $opendate = $opendate->format('m/d/Y');
        } else {
            $opendate = null;
        }

        $closedate = $reservation->close_date;
        if ($closedate) {
            $closedate = $closedate->format('m/d/Y');
        } else {
            $closedate = null;
        }
        $volunteers = Volunteer::getLibraryAssignments($reservation->inventory->library_id);
        $selectedVolunteer = $reservation->volunteer;

        $inventory = Inventory::getLibraryInventory($reservation->inventory->library_id);
        $selectedInventory = $reservation->inventory;
        return view('admin.reservations.edit', compact('reservation', 'opendate','closedate','volunteers','selectedVolunteer','inventory','selectedInventory'));
    }

    /**
     * Close Reservation
     */
    public function update(Request $request)
    {
        $id = $request->get('reservation_id');
        $inventory_id = $request->get('inventory_id');
        DB::table('reservations')
            ->where('id','=',$id)
            ->update([
                'open_date' => $this->change_date_format($request->get('open_date')),
                'close_date' => $this->change_date_format($request->get('close_date')),
                'remarks' => $request->get('remarks'),
                'volunteer_id' => $request->get('volunteer_id'),
                'inventory_id' => $inventory_id,
                'librarian_name' => $request->get('librarian_name'),
                'librarian_email' => $request->get('librarian_email'),
                'librarian_phone' => $request->get('librarian_phone'),
                'updated_at' => Carbon::now(),
            ]);
        // Closing or Updating Reservation?

        // If Closing Reservation
        if($request->get('closed_yn') == 1) {
            DB::table('reservations')
                ->where('id', '=', $id)
                ->update([
                    'closed_yn' => 1,
                    'status_id' => 2,
                    'updated_at' => Carbon::now(),
                ]);
            // Equipment Check

            $cp = $request->get('camera_present_yn');
            if(!$cp) {
                $cp = 0;
            }
            $pb = $request->get('plastic_box_yn');
            if(!$pb) {
                $pb = 0;
            }
            $l = $request->get('lock_yn');
            if(!$l) {
                $l = 0;
            }
            $il = $request->get('item_list_yn');
            if(!$il) {
                $il = 0;
            }
            $b = $request->get('batteries_yn');
            if(!$b) {
                $b = 0;
            }
            $sd = $request->get('sd_cards_yn');
            if(!$sd) {
                $sd = 0;
            }
            $cw = $request->get('camera_working_yn');
            if(!$cw) {
                $cw = 0;
            }
            $r = $request->get('check_remarks');

            DB::table('inventories')
                ->where('id', $inventory_id)
                ->update([
                    'camera_present_yn' => $cp,
                    'plastic_box_yn' => $pb,
                    'lock_yn' => $l,
                    'item_list_yn' => $il,
                    'batteries_yn' => $b,
                    'sd_cards_yn' => $sd,
                    'camera_working_yn' => $cw,
                    'checked_remarks' => $r,
                    'updated_at' => Carbon::now()
                ]);

            // 1-Available, 2-Reserved, 3-Missing, 4-Unavailable (unknown), 6-Unavailable (Equipment Missing/Failure)

            if ($cp == 0) {
                $status_id = 3; // Missing
            } else {
                $check_array = array($cp,$pb,$l,$il,$b,$sd,$cw);
                if (in_array(0, $check_array)) {
                    $status_id = 6; // Unavailable (Equipment Missing/Failure)
                } else {
                    $status_id = 1; // Available
                }
            }

            $updateStatus = Inventory::where('id', '=', $inventory_id)
                ->update([
                    'status_id' => $status_id,
                ]);

            DB::table('inventory_status_timestamps')
                ->insert([
                    'inventory_id' => $inventory_id,
                    'inventory_status_id' => $status_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            Session::flash('flash_message', 'Reservation Closed.');
        }
        else {
            $reopen = $request->get('reopen_yn');
            if($reopen == 1) {
                DB::table('reservations')
                    ->where('id','=',$id)
                    ->update([
                        'closed_yn' => 0,
                       'status_id' => 1,
                       'updated_at' => Carbon::now(),
                        ]);
                     DB::table('inventories')
                         ->where('id', $inventory_id)
                         ->update([
                             'camera_present_yn' => 0,
                             'plastic_box_yn' => 0,
                             'lock_yn' => 0,
                             'item_list_yn' => 0,
                             'batteries_yn' => 0,
                             'sd_cards_yn' => 0,
                             'camera_working_yn' => 0,
                             ]);
                Session::flash('flash_message', 'Reservation Reopened.');
            }
            else {
                Session::flash('flash_message', 'Reservation Updated.');
            }
        }
        return redirect()->action('Admin\ReservationsController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reservation::destroy($id);
        Session::flash('flash_message', 'Reservation deleted!');
        return redirect()->action('Admin\ReservationsController@index');
    }


    public function change_date_format($date)
    {
        if($date) {
            $dt = \DateTime::createFromFormat('m/d/Y', $date);
            return $dt->format('Y-m-d');
        }
        else {
            return null;
        }
    }
    public function change_date_format_back($date)
    {
        if($date) {
            $dt = \DateTime::createFromFormat('Y-m-d', $date);
            return $dt->format('d/m/Y');
        }
        else {
            return null;
        }
    }
}
