<?php

namespace App\Http\Controllers\Admin;
use App\MapSite;
use App\StaticArray;
use Session;
use Auth;
use App\SiteDescription;
use App\Volunteer;
use Carbon\Carbon;
use App\Signup;
use App\Camera;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapSelectionsController extends Controller
{
    public function index()
    {
        $statusSet = StaticArray::$siteDescriptionStatus;
        $counties = StaticArray::$nccounties;
        return view('admin.map-selections.datatable', compact('statusSet','counties'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $site = SiteDescription::find($id);
        $mapSite = MapSite::where('id','=',$site->map_site_id)->first();
        $volunteer = Volunteer::where('email','=',$site->email)->first();
        $signup = Signup::where('email','=',$site->email)->first();
        $camera = Camera::where('id','=',$site->camera_id)->first();
        $user = Auth::user();
        $statusSet = StaticArray::$siteDescriptionStatus;
        return view('admin.map-selections.show', compact('site','camera','user','volunteer','signup','statusSet'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = SiteDescription::find($id);
        return view('admin.map-selections.edit', compact('model'));
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
        $model = SiteDescription::findOrFail($id);
        $model->update($request->all());
        Session::flash('flash_message', 'Map Selection has been Updated.');
        return redirect()->action('Admin\MapSelectionsController@show', ['id' => $id]);
    }

    /**
     * Change Selected Site Status
     */
    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');

        $d = SiteDescription::find($id);
        $d->update([
            'status' => $status,
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('flash_message', 'Site Description status has been updated.');
        return redirect()->action('Admin\MapSelectionsController@show', ['id' => $id]);

    }
}
