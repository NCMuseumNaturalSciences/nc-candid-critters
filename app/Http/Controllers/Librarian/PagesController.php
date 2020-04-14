<?php

namespace App\Http\Controllers\Librarian;
use App\AvailabilityStatus;
use Auth;
use App\Library;
use DB;
use App\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function dashboard()
    {
        return redirect()->action('Librarian\LibraryController@show');
    }
}
