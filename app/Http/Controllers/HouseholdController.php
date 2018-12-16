<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
Use DB;
Use App\Person;
Use App\Evacuation;
Use App\HouseholdEvac;
Use App\HouseholdMember;
Use App\Household;

class HouseholdController extends Controller
{
    public function store(Request $request){
        $userId = Auth::id();
        $validate = $request->validate([
            'first_name'        => 'required',
            'last_name'         => 'required',
            'gender'            => 'required',
            'birth_date'        => 'required|date',
            'photo' => 'image|nullable|max:1999'
        ]);

        


        $person = new Person;
        $person->first_name = $request->first_name;
        $person->middle_name = $request->middle_name;
        $person->last_name = $request->last_name;
        $person->gender = $request->gender;
        $person->birth_date = $request->birth_date;
        $person->mobile_num = $request->mobile_num;
        $person->email = $request->email;
        $person->dead = 'No';
        
        //file upload
        if($request->hasFile('photo')){
            // get file name with extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('photo')->storeAs('public/uploads', $fileNameToStore);
            
        }else{
            switch($person->gender){
                case 'Male':
                    $file = "noimagemale.png";
                    break;
                case 'Female':
                    $file = "noimagefemale.png";         
            }
            $fileNameToStore = $file;
        }
        $person->photo = $fileNameToStore;
        $person->save();
        $personId = $person->id;

        $house = Household::select('id')->where('user_id', $userId)->first();
        $member = new HouseholdMember;
        $member->person_id = $personId;
        $member->house_id = $house->id;
        $member->registrant = 'No';
        $member->heirarchy = $request->heirarchy;
        $member->other_address = $request->other_address;
        $member->save();$lastEvac = Evacuation::where('status', 'Ongoing')->orderBy('id', 'desc')->first();
        if($lastEvac){
            $house_evac = new HouseholdEvac;
            $house_evac->household_member_id = $member->id;
            $house_evac->center_id = null;
            $house_evac->evacuation_id = $lastEvac->id;
            $house_evac->whereabouts = "Found";
            $house_evac->status = "Fine";
            $house_evac->remarks = "Registered during the event of an evacuation.";
            $house_evac->save();
        }

        //return redirect('/addHousehold')->with('success', 'A new member has been added!');
        return redirect('/viewHousehold')->with('success', 'A new member has been added!');
    }

    public function update(Request $request, $id){
        
        $validate = $request->validate([
            'first_name'        => 'required',
            'last_name'         => 'required',
            'gender'            => 'required',
            'birth_date'        => 'required|date'
            
        ]);


        $members = HouseholdMember::find($id);
        $members->heirarchy = $request->heirarchy;
        $members->other_address = $request->other_address;
        $members->save();

        $person = Person::find($members->person_id); 
        $person->first_name = $request->first_name;
        $person->middle_name = $request->middle_name;
        $person->last_name = $request->last_name;
        $person->gender = $request->gender;
        $person->birth_date = $request->birth_date;
        $person->birth_place = $request->birth_place;
        $person->mobile_num = $request->mobile_num;
        $person->email = $request->email;
        //file upload
        if($request->hasFile('photo')){
            // get file name with extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // get just extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('photo')->storeAs('public/uploads', $fileNameToStore);
            // save filename to db
            $person->photo = $fileNameToStore;    
        }else{
            if($person->photo == null){
                switch($person->gender){
                    case 'Male':
                        $file = "noimagemale.png";
                        break;
                    case 'Female':
                        $file = "noimagefemale.png";         
                }
                $fileNameToStore = $file;
            }
        }
        
        $person->save();
        
        return redirect('/viewHousehold')->with('success', 'You have updated your household information!');
   }   
}
