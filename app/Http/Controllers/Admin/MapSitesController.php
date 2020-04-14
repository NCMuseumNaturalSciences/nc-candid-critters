<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MapSite;
use App\StaticArray;
use Session;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MapSitesFormRequest;

class MapSitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.map-sites.datatable', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $nccounties = StaticArray::$nccounties;
        $coverTypes = StaticArray::$coverTypes;
        return view('admin.map-sites.create', compact('user','nccounties','coverTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MapSite::create($request->all());
        Session::flash('flash_message', 'Map Site added!');
        return redirect()->action('Admin\MapSitesController@index');
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
        $site = MapSite::find($id);
        return view('admin.map-sites.show',compact('site','user'));
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
        $site = MapSite::whereId($id)->firstOrFail();
        $nccounties = StaticArray::$nccounties;
        $coverTypes = StaticArray::$coverTypes;
        $siteStatus = StaticArray::$siteStatus;
        return view('admin.map-sites.edit', compact('site','user','nccounties','coverTypes','siteStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MapSitesFormRequest $request, $id)
    {
        $site = MapSite::findOrFail($id);
        $site->update($request->all());
        Session::flash('flash_message', 'Map Site updated!');
        return redirect()->action('Admin\MapSitesController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MapSite::destroy($id);
        Session::flash('flash_message', 'Map Site deleted!');
        return redirect()->action('Admin\MapSitesController@index');
    }
}
