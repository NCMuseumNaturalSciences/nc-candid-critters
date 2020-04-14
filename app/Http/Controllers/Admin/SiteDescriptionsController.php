<?php

namespace App\Http\Controllers\Admin;
use App\StaticArray;
use App\Volunteer;
use App\Camera;
use App\Deployment;
use App\Library;
use Auth;
use Carbon\Carbon;
use App\SiteDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
class SiteDescriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $statusSet = StaticArray::$siteDescriptionStatus;
        return view('admin.site-descriptions.datatable', compact('statusSet'));
    }
    /**
     * Display Site Descriptions by Uploader Type (Uploader/Non-uploader)
     */
    public function uploaders()
    {
        $statusSet = StaticArray::$siteDescriptionStatus;
        return view('admin.site-descriptions.uploader-datatable', compact('statusSet'));
    }
    public function nonuploaders()
    {
        $statusSet = StaticArray::$siteDescriptionStatus;
        return view('admin.site-descriptions.nonuploader-datatable', compact('statusSet'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $description = SiteDescription::find($id);
        $camera = Camera::where('id','=',$description->camera_id)->first();
        $user = Auth::user();
        $volunteer = Volunteer::where('email','=',$description->email)->first();
        return view('admin.site-descriptions.show', compact('description','camera','user','volunteer'));
    }
    /**
     * Edit Site Description
     *
    */
    public function edit($id)
    {

        $model = SiteDescription::whereId($id)->firstOrFail();
        $counties = StaticArray::$nccounties;
        if($model->acf_uploader_yn == 0) {
            $type = '1';
            $formtitle = "Non-uploader";
        }
        else if($model->acf_uploader_yn == 1) {
            $type = '2';
            $formtitle = "Uploader";
        }
        return view('admin.site-descriptions.forms.edit', compact('counties','model', 'type','formtitle'));
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
        $model->update($request->except('user_latitude','user_longitude'));
        if($model->deployment_yn == 1) {
            $d = Deployment::where('site_description_id','=',$model->id)->first();
            $d->update([
                'deployment_name' => $request->get('deployment_name')
            ]);
        }


        $model->update([
            'user_latitude' => $request->get('user_latitude'),
            'acf_lat' => $request->get('user_latitude'),
            'user_longitude' => $request->get('user_longitude'),
            'acf_long' => $request->get('user_longitude'),
        ]);


        Session::flash('flash_message', 'Site Description updated!');
        return redirect()->action('Admin\SiteDescriptionsController@show', ['id' => $id]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SiteDescription::destroy($id);
        Session::flash('flash_message', 'Site Description deleted!');
        return redirect()->action('Admin\SiteDescriptionsController@index');
    }
    /**
     * Create Deployment Record from Site Description Form Submission
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateSingleDeployment($id)
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
    public function activateMultipleDeployments()
    {

    }


}
