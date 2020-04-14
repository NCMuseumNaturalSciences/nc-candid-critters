<?php

namespace App\Http\Controllers\Admin;
use App\InventoryStatus;
use App\Reservation;
use App\Signup;
use Carbon\Carbon;
use Response;
use App\Inventory;
use App\Camera;
use DB;
use App\LibraryVolunteerAssignment;
use App\Library;
use App\StaticArray;
use App\Volunteer;
use Illuminate\Http\Request;
use App\Http\Requests\LibrariesFormRequest;
use Session;
use Auth;
use App\Http\Controllers\Controller;
class LibrariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.libraries.datatable', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $regions = StaticArray::$regions;
        $nccounties = StaticArray::$nccounties;
        return view('admin.libraries.create', compact('regions','nccounties','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibrariesFormRequest $request)
    {
        Library::create($request->all());
        Session::flash('flash_message', 'Library added!');
        return redirect()->action('Admin\LibrariesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $library = Library::find($id);
        $theVolunteers = DB::table('library_volunteer_assignments')
            ->join('volunteers','library_volunteer_assignments.volunteer_id','=','volunteers.id')
            ->join('libraries','library_volunteer_assignments.library_id','=','libraries.id')
            ->where('libraries.id','=',$id)
            ->select('library_volunteer_assignments.id as assignment_id',
                'volunteers.first_name',
                'volunteers.last_name',
                'volunteers.email',
                'library_volunteer_assignments.volunteer_id',
                'library_volunteer_assignments.library_id');
        $assignedVolunteers = $theVolunteers->get();
        $assigned = [];
            foreach($assignedVolunteers as $av) {
                $assigned[] = $av->volunteer_id;
        }
        $assignedCheck = array_filter($assigned);

            if($assignedCheck) {
                $volunteers = $theVolunteers->whereNotIn('volunteers.id',$assigned)->get();
            }
            else {
                $volunteers = Volunteer::all();
            }
        $cameras = Camera::all()->sortBy('make_model');
        $defaultCamera = Camera::where('make_model','=','Reconyx Hyperfire 2')->first();
        $inventory = Inventory::where('library_id','=',$id)->with('status')->get();
        $statusSet = InventoryStatus::all();
        $reservations = [];
        foreach($inventory as $i) {
            $reservation = Reservation::where('inventory_id','=',$i->id)->where('status_id','=',1)->first();
            if($reservation) {
                $reservations[] = $reservation;
            }
        }
        return view('admin.libraries.show',compact('library','user','assignedVolunteers','volunteers','cameras','inventory','statusSet','defaultCamera','reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $library = Library::whereId($id)->firstOrFail();
        $regions = StaticArray::$regions;
        $nccounties = StaticArray::$nccounties;
        return view('admin.libraries.edit', compact('library','regions','nccounties','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LibrariesFormRequest $request, $id)
    {
        $library = Library::findOrFail($id);
        $library->update($request->all());
        Session::flash('flash_message', 'Library updated!');
        return redirect()->action('Admin\LibrariesController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Library::destroy($id);
        Session::flash('flash_message', 'Library deleted!');
        return redirect()->action('Admin\LibrariesController@index');
    }


    /**
     * Get Library Assignments
     */
    public function getAssignments($library_id)
    {
        $library = Library::find($library_id);
        $libraries = Library::all();
        return view('admin.libraries.volunteers.manage-volunteers',compact('library','libraries'));
    }

    /**
     * Assign Volunteer to Library
     */
    public function assignVolunteer($volunteer_id)
    {
        if($volunteer_id) {
            $volunteer = Volunteer::where('id', '=', $volunteer_id)->first();
            $signup = Signup::where('id', '=', $volunteer->signup_id)->first();
            if($signup->library_id) {
                $chosenLibrary = Library::where('id','=',$signup->library_id)->first();
            }
            else {
                $chosenLibrary = null;
            }
        }
        else {
            $signup = null;
            $volunteer = null;
            $chosenLibrary = null;
        }
        $unassignedVolunteers = DB::table('volunteers')
            ->whereNotIn('id', function($query) {
                $query->select('volunteer_id')
                    ->from('library_volunteer_assignments');
                })
            ->get();
        $libraries = Library::all();


        //$chosenLibrary = Library::where('id','=',$volunteer_id)->first();
        return view('admin.libraries.assign.volunteer.create', compact('volunteer','unassignedVolunteers','libraries','chosenLibrary', 'signup'));
    }
    public function storeVolunteerAssignment(Request $request)
    {
        $libId = $request->get('library_id');
        $assignment = new LibraryVolunteerAssignment;
        $assignment->library_id = $request->get('library_id');
        $assignment->volunteer_id =  $request->get('volunteer_id');
        $assignment->save();
        return redirect()->action('Admin\LibrariesController@show', ['id' => $libId]);
    }

    /**
     * Delete Assignment
     */
    public function deleteAssignment(Request $request, $library_id, $assignment_id)
    {
        LibraryVolunteerAssignment::destroy($assignment_id);
        return redirect()->action('Admin\LibrariesController@show', ['id' => $library_id]);
    }

    /**
     * Add Camera to Inventory
     */
    public function addInventory(Request $request)
    {
        $libId = $request->get('library_id');
        $inventory = new Inventory;
        $inventory->camera_id = $request->get('camera_id');
        $inventory->library_id = $request->get('library_id');
        $inventory->barcode = $request->get('barcode');
        $inventory->nccc_id = $request->get('nccc_id');
        $inventory->status_id = 1;
//        $check->plastic_box_yn = "1";
//        $check->lock_yn = "1";
//        $check->item_list_yn = "1";
//        $check->batteries_yn = "1";
//        $check->sd_cards_yn = "1";
//        $check->camera_present_yn = "1";
//        $check->camera_working_yn = "1";
        $inventory->save();

        return redirect()->action('Admin\LibrariesController@show', ['id' => $libId]);
    }

    /**
     * Remove Camera from Inventory
     */
    public function deleteInventory(Request $request, $inventory_id)
    {
        $inventory = Inventory::find($inventory_id);
        $libId = $inventory->library_id;
        $inventory->delete();
        return redirect()->action('Admin\LibrariesController@show', ['id' => $libId]);
    }




}