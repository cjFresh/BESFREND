<?php

namespace App\Http\Controllers;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Barangay;
use Auth;
use App\User;
use App\Center;
use DB;

class CenterController extends Controller
{
    public function store(Request $request){
        $mytime = Carbon\Carbon::now();

        $user = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'accommodation'   => 'required',
            'lat'            => 'required|numeric',
            'lng'            => 'required|numeric',
            'location'       => 'required'
        ]);

        // $center = $request->validate([
        //     'accomodation'   => 'required',
        //     'lat'            => 'required|numeric',
        //     'lng'            => 'required|numeric',
        //     'location'       => 'required'
        // ]);
      
        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt(request('password'));
        $user->user_type = 'Evacuation Center Account';
        $user->save();
        $user_id = $user->id;     

        

        $center = new Center;
        $center->user_id = $user_id;
        /*kaning brgy id na line kay wa nakoy sure ana */
        $center->brgy_id = Auth::user()->center->brgy_id;
        $center->accommodation = $request->accommodation;
        $center->location = $request->location;
        $center->lat = $request->lat;
        $center->lng = $request->lng;
        $center->save();

        return redirect('/');

    }
}
