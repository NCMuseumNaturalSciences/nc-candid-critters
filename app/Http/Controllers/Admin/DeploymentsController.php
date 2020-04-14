<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Deployment;
use App\SiteDescription;
use App\StaticArray;
use App\Volunteer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
class DeploymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $statusSet = StaticArray::$siteDescriptionStatus;
        $setStatusSet = StaticArray::$deploymentSetStatus;
        return view('admin.deployments.datatable', compact('user','statusSet','setStatusSet'));
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
        $model = Deployment::find($id);
        $description = SiteDescription::find($model->site_description_id);
        $statusSet = StaticArray::$uploadedStatus;
        return view('admin.deployments.show',compact('model','user','statusSet','description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $deployment = Deployment::find($id);
        $volunteers = Volunteer::all()->sortBy('last_name');
        $selectedVolunteer = Volunteer::where('id','=',$deployment->volunteer_id)->first();
        $statusSet = StaticArray::$uploadedStatus;
        return view('admin.deployments.edit', compact('deployment','volunteers','selectedVolunteer','statusSet'));
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
        $deployment = Deployment::findOrFail($id);
        $deployment->update($request->all());
        if(!is_null($deployment->site_description_id)) {
            $sd = SiteDescription::where('id','=',$deployment->site_description_id)->first();
            $sd->update([
                'deployment_name' => $request->get('deployment_name')
            ]);
        }
        Session::flash('flash_message', 'Deployment updated!');
        return redirect()->action('Admin\DeploymentsController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deployment = Deployment::find($id);
        $description = SiteDescription::where('id','=',$deployment->site_description_id)
            ->update([
                'deployment_yn' => 0
            ]);
        Deployment::destroy($id);
        Session::flash('flash_message', 'Deployment deleted!');
        return redirect()->action('Admin\DeploymentsController@index');
    }
    /**
     * Change Site Description Status
     */
    public function changeStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');

        $d = Deployment::find($id);
        $d->update([
            'upload_status' => $status,
            'updated_at' => Carbon::now(),
        ]);
        Session::flash('flash_message', 'Upload status has been updated.');
        return redirect()->action('Admin\DeploymentsController@show', ['id' => $id]);
    }


    /**
     * Create Deployment Record from Site Description
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createSingleDeployment($id)
    {
        $d = SiteDescription::find($id);
        $deployCheck = Deployment::where('site_description_id' ,'=',$id)->first();
        if (is_null($deployCheck)) {
            $deploy = new Deployment;
            $deploy->deployment_lat = $d->acf_lat;
            $deploy->deployment_long = $d->acf_long;
            $deploy->site_description_id = $d->id;
            $deploy->deployment_name = $d->deployment_name;
            $deploy->acf_uploader_yn =$d->acf_uploader_yn;
            $deploy->acf_borrower_yn =$d->acf_borrower_yn;
            $deploy->created_at = Carbon::now()->toDateString();
            $deploy->updated_at = Carbon::now()->toDateString();
            $deploy->save();

            DB::table('site_descriptions')
                ->where('id','=',$d->id)
                ->update([
                    'deployment_yn' => '1',
                ]);

            // If volunteer record exists, set relationship
            $volunteer = Volunteer::where('email','=',$d->email)->first();
            if($volunteer) {
                $newdeploy = Deployment::find($deploy->id);
                $newdeploy->volunteer_id = $volunteer->id;
                $newdeploy->save();
                Session::flash('flash_message', 'Deployment Created with Volunteer');

            }
            else {
                Session::flash('flash_message', 'Deployment Created without Volunteer');
                return redirect()->action('Admin\DeploymentsController@edit', ['id' => $deploy->id]);
            }
        }
        else {
            Session::flash('flash_message', 'Deployment Already Exists');
            return redirect()->action('Admin\SiteDescriptionsController@index');
        }
    }


}
