<?php

namespace App\Http\Controllers\Librarian;
use App\Http\Requests\LibrarianReservationFormRequest;
use App\InventoryCheck;
use App\ReservationStatus;
use App\InventoryStatus;
use Session;
use DB;
use Carbon\Carbon;
use Auth;
use App\Library;
use App\Inventory;
use App\Reservation;
use App\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statusStr = 'All';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('librarian.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount'));
    }
    public function open()
    {
        $statusStr = 'Open';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('librarian.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount'));
    }
    public function closed()
    {
        $statusStr = 'Closed';
        $allCount = Reservation::count();
        $openCount = Reservation::getOpen()->count();
        $closedCount =  Reservation::getClosed()->count();
        return view('librarian.reservations.datatable', compact('statusStr','allCount', 'openCount','closedCount'));
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $library = Library::getMyLibrary($user->id)->first();
        $volunteers = DB::table('library_volunteer_assignments')
            ->join('volunteers','library_volunteer_assignments.volunteer_id','=','volunteers.id')
            ->join('libraries','library_volunteer_assignments.library_id','=','libraries.id')
            ->where('libraries.id','=',$library->library_id)
            ->select('library_volunteer_assignments.id as assignment_id',
                'volunteers.first_name',
                'volunteers.last_name',
                'volunteers.email',
                'library_volunteer_assignments.volunteer_id',
                'library_volunteer_assignments.library_id')
            ->get();
        $today = Carbon::now()->format('m/d/Y');
        $inventory = Inventory::where('library_id','=',$library->library_id)->with('status')->where('status_id','=',1)->get()->pluck('barcode','id');
        return view('librarian.reservations.create', compact('volunteers','inventory', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibrarianReservationFormRequest $request)
    {
        DB::table('reservations')->insert(array(
            'open_date' => $this->change_date_format($request->get('open_date')),
            'remarks' => $request->get('remarks'),
            'volunteer_id' => $request->get('volunteer_id'),
            'inventory_id' => $request->get('inventory_id'),
            'librarian_name' => $request->get('librarian_name'),
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
        Session::flash('flash_message', 'Reservation Complete.');
        return redirect()->action('Librarian\LibraryController@show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = DB::table('reservations_status')->join('reservations','reservations.status_id','=','reservations_status.id')->first();
        $reservation = Reservation::find($id);
        $inventory = Inventory::where('id','=',$reservation->inventory_id)->with('status')->first();
        return view('librarian.reservations.show', compact('reservation','status','inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $action)
    {
        $user = Auth::user();
        $library = Library::getMyLibrary($user->id)->first();
        $reservation = Reservation::find($id);
        $opendate = $reservation->open_date;
        if($opendate) {
            $opendate = $opendate->format('m/d/Y');
        }
        else {
            $opendate = null;
        }

        $closedate = $reservation->close_date;
        if($closedate) {
            $closedate = $closedate->format('m/d/Y');
        }
        else {
            $closedate = null;
        }
        $volunteers = DB::table('library_volunteer_assignments')
            ->join('volunteers','library_volunteer_assignments.volunteer_id','=','volunteers.id')
            ->join('libraries','library_volunteer_assignments.library_id','=','libraries.id')
            ->where('libraries.id','=',$library->library_id)
            ->select('library_volunteer_assignments.id as assignment_id', 
                'volunteers.first_name','volunteers.last_name',
                'volunteers.email',
                'library_volunteer_assignments.volunteer_id',
                'library_volunteer_assignments.library_id')
            ->get();
        $selectedVolunteer = Volunteer::where('id','=',$reservation->volunteer_id)->first();
        $inventory = Inventory::where('id','=',$reservation->inventory_id)->first();
            return view('librarian.reservations.edit', compact('action', 'opendate','closedate','library','reservation','volunteers', 'selectedVolunteer','inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LibrarianReservationFormRequest $request, $id)
    {
        $reservation = Reservation::find($id);
        DB::table('reservations')
            ->where('id','=',$reservation->id)
            ->update([
                'open_date' => $this->change_date_format($request->get('open_date')),
                'remarks' => $request->get('remarks'),
                //'volunteer_id' => $request->get('volunteer_id'),
                //'inventory_id' => $request->get('inventory_id'),
                'librarian_name' => $request->get('librarian_name'),
                'updated_at' => Carbon::now(),
            ]);
        Session::flash('flash_message', 'Reservation Updated.');
        return redirect()->action('Librarian\LibraryController@show');
    }
    /**
     * Close Reservation
     */
    public function close(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        DB::table('reservations')
            ->where('id','=',$reservation->id)
            ->update([
                'open_date' => $this->change_date_format($request->get('open_date')),
                'close_date' => $this->change_date_format($request->get('close_date')),
                'remarks' => $request->get('remarks'),
                //'volunteer_id' => $request->get('volunteer_id'),
                //'inventory_id' => $request->get('inventory_id'),
                'librarian_name' => $request->get('librarian_name'),
                'updated_at' => Carbon::now(),
            ]);
        // Closing or Updating Reservation?

        // If Closing Reservation
        if($request->get('closed_yn') == 1) {
            DB::table('reservations')
                ->where('id', '=', $reservation->id)
                ->update([
                    'closed_yn' => 1,
                    'status_id' => 2,
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
                ->where('id', $reservation->inventory_id)
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

            if ($cp == 0) {
                $status_id = 3;
            } else {
                $check_array = array($cp,$pb,$l,$il,$b,$sd,$cw);
                if (in_array(0, $check_array)) {
                    // Equipment Check Failure
                    $status_id = 2;
                } else {
                    $status_id = 1;
                }
            }

            $updateStatus = Inventory::where('id', '=', $reservation->inventory_id)
                ->update([
                    'status_id' => $status_id,
                ]);

            DB::table('inventory_status_timestamps')
                ->insert([
                    'inventory_id' => $reservation->inventory_id,
                    'inventory_status_id' => $status_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            Session::flash('flash_message', 'Reservation Closed.');
        }
        else {
            Session::flash('flash_message', 'Reservation Updated.');
        }
        return redirect()->action('Librarian\LibraryController@show');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $inventory = Inventory::where('id','=',$reservation->inventory_id)->first();
        DB::table('inventories')
            ->where('id','=',$inventory->id)
            ->update([
                'status_id' => 1
            ]);
        Reservation::destroy($id);
        Session::flash('flash_message', 'Reservation deleted!');
        return redirect()->action('Librarian\LibraryController@show');
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
