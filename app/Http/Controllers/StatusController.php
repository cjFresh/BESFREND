<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barangay;
use App\HouseholdMember;
use Auth;
use App\Person;
use App\User;
use App\Household;
use App\HouseholdEvac;
use App\Center;
use DB;

class StatusController extends Controller
{
    public function update(Request $request, $id){
        $stats = HouseholdEvac::find($id);
        $stats->whereabouts = $request->whereabouts;
        $stats->status = $request->status;
        $stats->remarks = $request->remarks;
        $stats->save();
        return redirect('/status');
    }
}
