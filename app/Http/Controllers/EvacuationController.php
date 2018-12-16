<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barangay;
use App\HouseholdEvac;
use App\HouseholdMember;
use App\MedicalBackground;
use App\Center;
use App\Evacuation;
use App\Person;
use App\AidWorkerAssignment;
use Carbon;
use Auth;
use DB;

class EvacuationController extends Controller
{
    public function open(Request $request){
        //echo Auth::user()->center->brgy_id;
        date_default_timezone_set('Asia/Singapore');
        $mytime = Carbon\Carbon::now();
        $validate = $request->validate([
            'emergency'    => 'required',
            'remarks'      => 'required'
        ]);

        $evac = new Evacuation;
        $evac->emergency = $request->emergency;
        $evac->remarks = $request->remarks;
        $evac->brgy_id = Auth::user()->center->brgy_id;
        $evac->status = "Ongoing";
        $evac->save();
        // I CHANGED THIS - CLEM (10/13/18 10:43 AM)
        $household_member = HouseholdMember::all();
        foreach($household_member as $h){
            if($h->person->dead != "Yes" && $h->household->active_check != "No"){ // NEW CHANGES NING IF (NOT TESTED) as of 11-7-18
                $household_evac = new HouseholdEvac(['evacuation_id' => $evac->id, 'whereabouts' => 'Found', 'status' => 'Fine', 'remarks' => 'Default data, change when necessary.']);
                $h->household_evac()->save($household_evac);
            }
        }
        return redirect('/viewCenters')->with('success', 'You have initiated the evacuation!');
    }

    public function close($id){
        $evac = Evacuation::find($id);
        $evac->status = "Done";
        $evac->save();

        $aidRequest = AidWorkerAssignment::where('center_id', '<>', Auth::user()->center->id)->where('status', '<>', 'Transferred')->get();
        foreach($aidRequest as $a){
            //echo $a->status;
            $a->status = "Transferred";
            $a->save();
            $callBack = new AidWorkerAssignment;
            $callBack->aid_worker_id = $a->aid_worker_id;
            $callBack->center_id = Auth::user()->center->id;
            $callBack->status = "Present";
            $callBack->save();
        }

        return redirect('/viewCenters')->with('success', 'You have closed the evacuation!');
    }
    
    public function assignThis($id){
        $centerId = Center::select('id')->where('user_id', Auth::id())->first();
        $evacuee = HouseholdEvac::find($id);
        $evacuee->center_id = $centerId->id;

        //new code by CLEM 
        if($evacuee->whereabouts == "Missing"){
            $evacuee->whereabouts = "Found";
            $evacuee->status = "Fine";
        }

        $evacuee->save();
        
        return redirect('/evacuateHere')->with('success', 'Evacuee Assigned!');
    }

    public function evacueeUpdate(Request $request,$id){
        $validate = $request->validate([
            'whereabouts'    => 'required',
            'status'         => 'required',
            'remarks'       => 'required'
        ]);

        $stats = HouseholdEvac::find($id);
        $stats->whereabouts = $request->whereabouts;
        $stats->status = $request->status;
        $stats->remarks = $request->remarks;
        $stats->save();
        return redirect('/evacueeEdit/'.$id)->with('success', 'Successfully Updated!');
    }

    public function updateMed(Request $request, $id){
        $validate = $request->validate([
            'condition'    => 'required',
            'severity'      => 'required',
            'medication'      => 'required'
        ]);

        $medrec = MedicalBackground::find($id);
        $medrec->condition = $request->condition;
        $medrec->severity = $request->severity;
        $medrec->medication = $request->medication;
        $medrec->save();
        $evacs_id = $request->evac_id;
        return redirect('/evacueeEdit/'.$evacs_id)->with('success', 'You have updated your medical record!');
   }

   public function evacueemedAdd(Request $request, $id){
        $validate = $request->validate([
            'condition'    => 'required',
            'severity'      => 'required',
            'medication'      => 'required'
        ]);       
        $medrec = new MedicalBackground;
        $medrec->household_member_id = $request->member_id;
        $medrec->condition = $request->condition;
        $medrec->severity = $request->severity;
        $medrec->medication = $request->medication;
        $medrec->save();

    return redirect('/evacueeEdit/'.$id)->with('success', 'Medical Record Successfuly Added!');
   }

      // not working
   public function dead(Request $request, $id){
        $stats = HouseholdEvac::find($id);
        $stats->status = 'Deceased';
        $stats->remarks = $request->remarks;
        $person = Person::find($stats->household_member->person_id);
        $person->dead = "Yes";
        $person->save();
        $stats->save();
        return redirect('/evacueeEdit/'.$id)->with('error', 'Successfully updated the status to dead');
    }

    public function missing(Request $request, $id){
        $stats = HouseholdEvac::find($id);
        $stats->whereabouts = 'Missing';
        if($stats->status != "Injured/Sick"){
            $stats->status = 'Unknown';
        }
        $stats->remarks = $request->remarks;
        $stats->save();
        if(Auth::user()->user_type == "Household Account"){
            return redirect('/status')->with('success', 'Successfully updated the status to missing');
        }else{
            return redirect('/evacueeEdit/'.$id)->with('success', 'Successfully updated the status to missing');
        }
    }

    public function found(Request $request, $id){
        $stats = HouseholdEvac::find($id);
        $stats->whereabouts = 'Found';
        $stats->status = $request->status;
        $stats->remarks = $request->remarks;
        $stats->save();
        if(Auth::user()->user_type == "Household Account"){
            return redirect('/status')->with('success', 'Successfully updated the status to found');
        }else{
            return redirect('/evacueeEdit/'.$id)->with('success', 'Successfully updated the status to found.');
        }
    }

    public function sick(Request $request, $id){
        $stats = HouseholdEvac::find($id);
        $stats->status = 'Injured/Sick';
        $stats->remarks = $request->remarks;
        $stats->save();
        if(Auth::user()->user_type == "Household Account"){
            return redirect('/status')->with('success', 'Successfully updated the status to sick/injured');
        }else{
            return redirect('/evacueeEdit/'.$id)->with('error', 'Successfully updated the status to sick/injured');
        }
    }

    public function fine(Request $request, $id){
        $stats = HouseholdEvac::find($id);
        $stats->status = 'Fine';
        $stats->save();
        return redirect('/evacueeEdit/'.$id)->with('success', 'Successfully updated the status to fine');
    }
}
