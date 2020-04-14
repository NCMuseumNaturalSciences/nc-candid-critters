<?php

namespace App\Http\Controllers\Librarian;
use Auth;
use App\Library;
use DB;
use App\EquipmentStatus;
use App\AvailabilityStatus;
use App\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StaticArray;
use App\InventoryStatus;
use App\InventoryStatusTimestamp;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        $library = Library::getMyLibrary($user->id)->first();
        $assignedVolunteers = DB::table('library_volunteer_assignments')
            ->join('volunteers','library_volunteer_assignments.volunteer_id','=','volunteers.id')
            ->join('libraries','library_volunteer_assignments.library_id','=','libraries.id')
            ->where('libraries.id','=',$library->library_id)
            ->select('library_volunteer_assignments.id as assignment_id',
                'volunteers.first_name','volunteers.last_name',
                'volunteers.email',
                'volunteers.telephone',
                'library_volunteer_assignments.volunteer_id',
                'library_volunteer_assignments.library_id')
            ->get();
        $inventory = Inventory::where('library_id','=',$library->library_id)->with('status')->get();
        $statusSet = InventoryStatus::all();
        return view('librarian.library.show', compact('user','library','assignedVolunteers','inventory','statusSet'));
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
        $library = Library::getMyLibrary($user->id)->first();
        $regions = StaticArray::$regions;
        $nccounties = StaticArray::$nccounties;
        return view('librarian.library.edit', compact('library','regions','nccounties','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $library = Library::findOrFail($id);
        $library->update($request->all());
        Session::flash('flash_message', 'Library updated!');
        return redirect()->action('Librarian\LibrariesController@show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
