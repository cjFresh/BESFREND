<?php

namespace App\Http\Controllers;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\HouseholdEvac;
use App\AidWorker;
use App\Center;
use App\AidWorkerAssignment;
use App\Person;
use App\WorkerRequest;
use DB;

class AidController extends Controller
{   
    public function addaid(Request $request){
        date_default_timezone_set('Asia/Singapore');
        $mytime = Carbon\Carbon::now();

        $validate = $request->validate([
            'first_name'        => 'required',
            'last_name'         => 'required',
            'gender'            => 'required',
            'birth_date'        => 'required|date',
            'field'             => 'required'
        ]);
        
        $person = new Person;
        $person->first_name = $request->first_name;
        $person->middle_name = $request->middle_name;
        $person->last_name = $request->last_name;
        $person->gender = $request->gender;
        $person->birth_date = $request->birth_date;
        $person->birth_place = NULL;
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
        $person_id = $person->id;
      
        $aid = new AidWorker;
        $aid->person_id = $person->id;
        $aid->field= $request->field;
        $aid->status = "Active";
        $aid->save();
        
        return redirect('/viewAid')->with('success', 'Aid Worker Registered!');
    }
    
    public function update(Request $request){
        $aid = AidWorker::find($request->id);
        $aid->field = $request->field;
        //$aid->assigned_center_id = $request->center_id; udpated by FRESH
        $aid->save();
        // $var_dump($request);

        $validate = $request->validate([
            'first_name'        => 'required',
            'last_name'         => 'required',
            'gender'            => 'required',
            'birth_date'        => 'required|date',
            'field'             => 'required',
            'mobile_num'        => 'string|min:1|max:11'
        ]);

        $person = Person::find($aid->person_id); 
        $person->first_name = $request->first_name;
        $person->middle_name = $request->middle_name;
        $person->last_name = $request->last_name;
        $person->gender = $request->gender;
        $person->birth_date = $request->birth_date;
        $person->birth_place = $request->birth_place;
        $person->mobile_num = $request->mobile_num;
        $person->email = $request->email;
        // add nya tag photo nga column
        $person->save();
        
        switch(Auth::user()->user_type){
            case "Command Center Account":
                return redirect('/viewAid')->with('success', 'Successfully edited aidworker info');
                break;
            case "Evacuation Center Account":
                // kani kay mao man tong ma tang tang siyas lista sa aid workers nga ni belong ani nga center
                return redirect('/viewAidHere')->with('success', 'Successfully edited aidworker info');
                break;
        }
    }

    // Fresh 10/24
    public function assignAidWorker(Request $request, $worker_id){
        date_default_timezone_set('Asia/Singapore');
        $mytime = Carbon\Carbon::now();
        
        if($request->last_assignment_id != 0){
            $last = AidWorkerAssignment::find($request->last_assignment_id);
            $last->status = "Last Post";
            $last->save();
        }

        $newAss = new AidWorkerAssignment;
        $newAss->aid_worker_id = $worker_id;
        $newAss->center_id = $request->center;
        $newAss->status = "En Route";
        $newAss->save();
        
        switch(Auth::user()->user_type){
            case "Command Center Account":
                return redirect('/viewSelecetedAidWorker/'.$worker_id)->with('success', $newAss->aid_worker->person->first_name." ".$newAss->aid_worker->person->last_name." has been assigned to ".$newAss->center->locaton.", pending confirmation of arrival.");
                break;
            case "Evacuation Center Account":
            return redirect('/viewAidHere')->with('success', $newAss->aid_worker->person->first_name." ".$newAss->aid_worker->person->last_name." has been assigned to ".$newAss->center->locaton.", pending confirmation of arrival.");
                break;
        }
    }
    
    //start of kamandag
    public function requestAid(Request $request){
     
        $reqAid = $request->validate([
            'center_id' => 'required',
            'num_staff_needed'=> 'required|numeric|min:3',
            'reasons' => 'required',
            'status'=> 'required'
          ]);

        $reqAid = new WorkerRequest;
        $reqAid->center_id = $request->center_id;
        $reqAid->num_staff_needed = $request->num_staff_needed;
        $reqAid->reasons = $request->reasons;
        $reqAid->status = $request->status;
        $reqAid->save();
        
        return redirect('/viewRequest');
    }
    //end of kamandag

    //10-16-18 kamandag
    public function assignThis($id, $centerid, $worker_id){
       

        $assign = AidWorkerAssignment::where('aid_worker_id', $worker_id)
                                        ->where('center_id', Auth::user()->center->id)
                                        ->where('status', 'Present')
                                        ->first();
        $assign->status = 'Last Post';
        $assign->save();
        $newAssignment = new AidWorkerAssignment;
        $newAssignment->aid_worker_id = $worker_id;
        $newAssignment->center_id = $centerid;
        $newAssignment->status = "En Route";
        $saved = $newAssignment->save();
        if($saved){
            $delete = WorkerRequest::where('id', $id)->decrement('num_staff_needed', 1);
            return redirect()->action('AidController@redirectaid', $id)->with('success', 'Successfuly assigned Aidworker!');
        }else
        return redirect('/manageAid');
    }

    public function approveaid(Request $request, $id){
      
        $centerid = WorkerRequest::select('center_id')->where('id', $id)->first();
        $approve = WorkerRequest::find($id);
        $approve->status = 'Approved';
        $approve->final_remarks = $request->final_remarks;
        $copy = $approve->final_remarks;
        $approve->save();
        
        $copyRemark = WorkerRequest::find($id);
        $copyRemark->final_remarks = $copy;
        $copyRemark->save();

        $availableAid = AidWorkerAssignment::where('center_id', Auth::user()->center->id)
                                            ->where('status', 'Present')->get();
        echo Auth::user()->center->id;
        // var_dump($availableAid);

        return view('aidworker.assign')->with('availableAid', $availableAid)
                                       ->with('centerid', $centerid)
                                       ->with('id', $id)
                                       ->with('assignthisfor', $approve);
    }

    //redirect after assigning
    public function redirectaid($id){

        $centerid = WorkerRequest::select('center_id')->where('id', $id)->first();
        $copyRemark = WorkerRequest::find($id);

        $availableAid = AidWorkerAssignment::where('center_id', Auth::user()->center->id)
        ->where('status', 'Present')->get();

        return view('aidworker.assign')->with('availableAid', $availableAid)
        ->with('centerid', $centerid)
        ->with('id', $id)
        ->with('assignthisfor', $copyRemark);
    }
    public function confirmaidArrival($id){
        $approveAid = AidWorkerAssignment::find($id);
        $approveAid->status = 'Present';
        $worker = $approveAid->aid_worker_id;
        $approveAid->save();
        
        $lastAssignment = AidWorkerAssignment::where('aid_worker_id', $worker)->where('status', "Last Post")->orderBy('id', 'desc')->first();
        $lastAssignment->status = "Transferred";
        $lastAssignment->save();

        return redirect('/viewAidHere')->with('success', 'Successfuly Approved Incoming Aid!');
       }
    
       //new kamandag
       public function denyAid(Request $request, $id){
        $denyAid = WorkerRequest::find($id);
        $denyAid->final_remarks = $request->final_remarks;
        $denyAid->status = 'Denied';
        $denyAid->save();

        return redirect('/manageAid')->with('success', 'Aid Request Denied!');
       }


       public function recallaid($id){
            $assignment = AidWorkerAssignment::find($id);
            //echo $id;
            $worker = $assignment->aid_worker_id;
            //echo $assignment->aid_worker->person->first_name." ".$assignment->aid_worker->person->first_name;
            $assignment->delete();
            $lastAssignment = AidWorkerAssignment::where('aid_worker_id', $worker)->where('status', 'Last Post')->orderBy('id', 'desc')->first();
            $lastAssignment->status = "Present";
            $lastAssignment->save();
            switch(Auth::user()->user_type){
                case "Command Center Account":
                return redirect ('/manageAid')->with('success', 'Aidworker has been recalled to the evacuation center!');
                    break;
                case "Evacuation Center Account":
                    // kani kay mao man tong ma tang tang siyas lista sa aid workers nga ni belong ani nga center
                    break;
            }         
        } 

       //clem codes
       public function cancelAssignment($assign_id){
        $assignment = AidWorkerAssignment::find($assign_id);
        $worker = $assignment->aid_worker_id;
        $assignment->delete();
        $lastAssignment = AidWorkerAssignment::where('aid_worker_id', $worker)->where('status', 'Last Post')->orderBy('id', 'desc')->first();
        $lastAssignment->status = "Present";
        $lastAssignment->save();
        switch(Auth::user()->user_type){
            case "Command Center Account":
                return redirect('/viewSelecetedAidWorker/'.$worker)->with('success', $lastAssignment->aid_worker->person->first_name." ".$lastAssignment->aid_worker->person->last_name." has been called back to ".$lastAssignment->center->location.".");
                break;
            case "Evacuation Center Account":
                // kani kay mao man tong ma tang tang siyas lista sa aid workers nga ni belong ani nga center
                break;
        }
    }
}
