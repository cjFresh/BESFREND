<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Center;
use App\Announcement; 
 use Carbon;
use DB;


class AnnouncementController extends Controller
{
    /* testing pani siya */
    public function store(Request $request){
        date_default_timezone_set('Asia/Singapore');
        $mytime = Carbon\Carbon::now();
        //$center = Center::select('id')->where('user_id', Auth::id())->first();
        $announce = new Announcement;
        $announce->center_id = Auth::user()->center->id;
        $announce->title = $request->title;
        $announce->body = $request->body;
        $announce->save();
        
        /* tempo */
        return redirect('/home');
    }

    public function deleteAnnouncement($id){
        $announce = Announcement::find($id)->delete();
        return redirect('/home');
    }

    public function update(Request $request, $id){
        $announce = Announcement::find($id);
        $announce->title = $request->title;
        $announce->body = $request->body;
        $announce->save();

        return redirect('/home');
    }
}
