<?php

namespace App\Http\Controllers\Admin;
use App\LibraryVolunteerAssignment;
use App\Deployment;
use DB;
use Session;
use App\Library;
use App\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Signup;
class VolunteersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.volunteers.datatable', compact('user'));
    }

    /**
     * Datatable for Volunteer Rewards
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rewards()
    {
        return view('admin.volunteers.rewards-datatable');
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
    public function show($id)
    {
        $user = Auth::user();
        $model = Volunteer::find($id);
        $signup = Signup::where('id','=',$model->signup_id)->first();
        $library = Library::where('id','=',$signup->library_id)->first();
        $assignedLibraries = DB::table('libraries')
            ->join('library_volunteer_assignments','libraries.id','=','library_volunteer_assignments.library_id')
            ->where('library_volunteer_assignments.volunteer_id','=',$model->id)
            ->select([
                'libraries.id as library_id',
                'libraries.library_name',
                'library_volunteer_assignments.id as assignment_id',
                'library_volunteer_assignments.volunteer_id'
            ])
            ->get();
        $deploymentCount = Deployment::where('volunteer_id','=',$model->id)->get()->count();
        return view('admin.volunteers.show',compact('model','user','library', 'assignedLibraries','signup','deploymentCount'));
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
        $model = Volunteer::find($id);
        return view('admin.volunteers.edit', compact('model','user'));
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
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->update($request->all());
        Session::flash('flash_message', 'Volunteer has been Updated.');
        return redirect()->action('Admin\VolunteersController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Volunteer::destroy($id);
        Session::flash('flash_message', 'Volunteer deleted!');
        return redirect()->action('Admin\VolunteersController@index');
    }

    public function getAssignedVolunteers($id)
    {
        $volunteers = DB::table('library_volunteer_assignments')
            ->join('volunteers','library_volunteer_assignments.volunteer_id','=','volunteers.id')
            ->join('libraries','library_volunteer_assignments.library_id','=','libraries.id')
            ->where('libraries.id','=',$id)
            ->select(
                DB::raw("CONCAT(volunteers.first_name, ' ', volunteers.last_name) as volunteer_name"),
                'library_volunteer_assignments.volunteer_id'
            )
            ->get();
        return $volunteers;
    }

    /**
     * Delete Assignment
     */
    public function deleteAssignment(Request $request, $volunteer_id, $assignment_id)
    {
        LibraryVolunteerAssignment::destroy($assignment_id);
        return redirect()->action('Admin\VolunteersController@show', ['id' => $volunteer_id]);
    }

}
