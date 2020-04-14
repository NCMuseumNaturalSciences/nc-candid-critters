<?php

namespace App\Http\Controllers\Librarian;
use App\User;
use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Inventory;
use Session;
class ProfileController extends Controller
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
        $id = Auth::user()->getId();
        $user = User::whereId($id)->firstOrFail();
        $library = User::getMyLibrary();
        $reservationCount = Reservation::getMyReservations()->count();
        $inventoryCount = Inventory::getMyInventory()->count();
        return view('librarian.profile.show', compact('user','library','reservationCount','inventoryCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = Auth::user()->getId();
        $user = User::whereId($id)->firstOrFail();
        return view('librarian.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->getId();
        $user = User::whereId($id)->firstOrFail();
        $user->fname = $request->get('fname');
        $user->lname = $request->get('lname');
        $user->email = $request->get('email');
        $password = $request->get('password');
        if($password != "") {
            $user->password = Hash::make($password);
        }
        $user->save();
        Session::flash('flash_message', 'Profile updated!');
        return redirect(action('Librarian\ProfileController@show'));
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
