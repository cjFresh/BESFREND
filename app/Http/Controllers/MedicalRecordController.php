<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MedicalBackground;
use App\HouseholdMember;
use DB;

class MedicalRecordController extends Controller
{

    public function update(Request $request, $id){
        $validate = $request->validate([
            'condition'        => 'required',
            'severity'         => 'required',
            'medication'       => 'required'
        ]);

        $medrec = MedicalBackground::find($id);
        $medrec->condition = $request->condition;
        $medrec->severity = $request->severity;
        $medrec->medication = $request->medication;
        $medrec->save();
        return redirect('/view/'.$medrec->household_member_id)->with('success', 'You have updated '.$medrec->condition.'!');
   }   

   public function store(Request $request){ 
        $validate = $request->validate([
            'condition'        => 'required',
            'severity'         => 'required',
            'medication'       => 'required'
        ]);

        $medrec = new MedicalBackground;
        $medrec->household_member_id = $request->id;
        $medrec->condition = $request->condition;
        $medrec->severity = $request->severity;
        $medrec->medication = $request->medication;
        $medrec->save();
    
        return redirect('/view/'.$medrec->household_member_id);
    }
}   



