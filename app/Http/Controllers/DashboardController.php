<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function router()
    {
        $user = Auth::user();
        if ( $user->hasRole('administrator') )
        {
            return redirect('admin/dashboard');
        }
        if ( $user->hasRole('librarian') )
        {
            return redirect('librarian/dashboard');
        }
        else {
            return redirect()->action('PagesController@unauthorized');
        }
    }

}
