<?php

namespace App\Http\Controllers;
use App\Camera;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PagesController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function unauthorized()
    {
        $user = Auth::user();
        return view('admin.unauthorized', compact('user'));
    }

}

