<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use App\Evacuation;
use App\HouseholdEvac;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // take three or less latest announcements
        $latest_boards = Announcement::orderBy('id', 'desc')->take(3)->get();
        $evac = Evacuation::orderBy('id', 'desc')->first();
        $household_evac = HouseholdEvac::where('evacuation_id', $evac->id)->get();
        return view('home')->with('latest_announcements', $latest_boards)->with('household_evac', $household_evac);
                    /*sakto ang syntax and placement sa code? */
            
            //echo $household_evac;
            // return redirect('/home')->with('household_evac', $household_evac);
    }
}
