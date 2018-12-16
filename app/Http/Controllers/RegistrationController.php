<?php

namespace App\Http\Controllers;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use Auth;
Use DB;
Use App\Person;
Use App\Household;
Use App\HouseholdMember;
use App\HouseholdEvac;
Use App\Evacuation;
Use App\User;

class RegistrationController extends Controller
{
    public function store(Request $request){
        $mytime = Carbon\Carbon::now();
        date_default_timezone_set('Asia/Singapore');

        $validate = $request->validate([
            'first_name'        => 'required',
            'last_name'         => 'required',
            'gender'            => 'required',
            'birth_date'        => 'required|date',
            'house_no'         => 'required',
            'street'            => 'required',
            'area'              => 'required'
        ]);

        if($request->password == $request->password_confirmation){
        
        $person = new Person;
        $person->first_name = $request->first_name;
        $person->middle_name = $request->middle_name;
        $person->last_name = $request->last_name;
        $person->gender = $request->gender;
        $person->birth_date = $request->birth_date;
        $sample = '0'.$request->mobile_num;
        $person->mobile_num = $sample;       
        $person->email = $request->email;
        $person->dead = "No";
        switch($person->gender){
            case 'Male':
                $file = "noimagemale.png";
                break;
            case 'Female':
                $file = "noimagefemale.png";         
        }
        $person->photo = $file;
        $person->save();
        $person_id = $person->id;
      
        $user = new User;
        $user->username = $request->username;
        $user->password = bcrypt(request('password'));
        $user->user_type = 'Household Account';
        $user->save();
        $user_id = $user->id;

        $house = new Household;
        $house->user_id = $user_id;
        $house->house_num = $request->house_no;
        $house->street = $request->street;
        $house->area = $request->area;
        $house->brgy_id = $request->brgy_id;
        $house->save();
        $house_id = $house->id;

        $member = new HouseholdMember;
        $member->person_id = $person_id;
        $member->house_id = $house_id;
        $member->registrant = 'Yes';
        $member->heirarchy = 'Not Applicable';
        $member->other_address = null;
        $member->save();

        $lastEvac = Evacuation::where('status', 'Ongoing')->orderBy('id', 'desc')->first();
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

        $credentials = array(
            'id' => $user_id,
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'user_type' => $user->user_type
        );
        
        if (Auth::attempt($credentials)) {
            return Redirect::to('home');
        }
    

            return redirect('/')->with('success', 'Household Member Registered!');
        }else{
            return redirect('/')->with('error','Password does not match');
        }

    }
}
