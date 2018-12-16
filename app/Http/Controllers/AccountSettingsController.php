<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
Use App\User;
Use App\Household;
class AccountSettingsController extends Controller
{
    public function updateAccountSettings(Request $request, $id){
        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ]);
        $account = User::find($id);
        $reqAid = $request->validate([
            'username' => 'required',
            'password'=> 'required'
          ]);
        $account->username = $request->username;
        $account->password = bcrypt(request('password'));
        $saved=$account->save();

        if($saved){
        $userHouse = Household::where('user_id', Auth::user()->id)->first();
        $userHouse->house_num = $request->house_num;
        $userHouse->street = $request->street;
        $userHouse->area = $request->area;
        $userHouse->save();
        return redirect('/home')->with('success', 'Successfuly Edited Account Settings!'); 
        }else if(!$saved){  
            return redirect('/accountSettings')->with('danger', 'Cannot change password!');
        
        }
    }
    // new codes of clem
    public function deactivate($user_id){
        $household = Household::find($user_id);
        $household->active_check = "No";
        $household->save();

        return redirect('/home')->with('success',"Your account is successfully deactivated");
    }

    public function reactivateAccount($id){

        $reactivate = Household::find($id);
        $reactivate->active_check = 'Yes';
        $reactivate->save();

        return redirect('/reactivate')->with('success', 'Successfuly Reactivated Account!');
    }
}
