<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\Camera;
use Illuminate\Http\Request;
use App\Http\Requests\CamerasFormRequest;
use App\Http\Controllers\Controller;
class CamerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.cameras.datatable', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.cameras.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CamerasFormRequest $request)
    {
        Camera::create($request->all());
        Session::flash('flash_message', 'Camera added!');
        return redirect()->action('Admin\CamerasController@index');
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
        $camera = Camera::find($id);
        return view('admin.cameras.show',compact('camera','user'));
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
        $camera = Camera::whereId($id)->firstOrFail();
        return view('admin.cameras.edit', compact('camera','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CamerasFormRequest $request, $id)
    {
        $camera = Camera::findOrFail($id);
        $camera->update($request->all());
        Session::flash('flash_message', 'Camera updated!');
        return redirect()->action('Admin\CamerasController@show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$camera = Camera::findOrFail($id);
        //$camera->delete();
        Camera::destroy($id);
        Session::flash('flash_message', 'Camera deleted!');
        return redirect()->action('Admin\CamerasController@index');
    }
}
