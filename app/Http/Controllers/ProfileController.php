<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show() {
        $user = Auth::user();
//        $id = Auth::user()->getId();
//        $user = User::whereId($id)->firstOrFail();
        return view('profiles.show', compact('user'));
    }

}
