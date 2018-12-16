<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Barangay;
use App\HouseholdMember;
use Auth;
use App\Person;
use App\User;
use App\Household;
use App\MedicalBackground;
use App\HouseholdEvac;
use App\AidWorker;
use App\Center;
use App\Evacuation;
use App\Inventory;
use App\WorkerRequest;
use App\Announcement; 
use App\ReliefOperation;
use App\ReliefPackage;
use App\Item;
use App\ItemRequestForm;
use App\ItemRequestList;
use App\AidWorkerAssignment;
use Carbon;
use DB;


class PagesController extends Controller
{
    public function index(){
        if(!Auth::user()){
            $brgy = Barangay::all();
            return view('pages.welcome')->with('brgy', $brgy);
        }else{

            return redirect('/home');
        }
    }
    
    public function add_household_member(){
        return view('household.add');
    }

    public function viewAll(){
        $house = Household::select('id')->where('user_id', Auth::id())->first();
        $members = HouseholdMember::where('house_id', $house->id)->get();
        //var_dump($members);
        return view('household.index')->with('members', $members);
    }

    public function editHousehold(Request $request, $id){
        $members = HouseholdMember::find($id);
        return view('household.edit')->with('members', $members);
    } 

    //for medbackground
    public function viewMed(){
        $household = Household::select('id')->where('user_id', Auth::id())->first();
        $members = HouseholdMember::where('house_id', $household->id)->get();
        $medrec = MedicalBackground::all();
        //var_dump($members);
        /*foreach($members as $m){
            echo $m->id;
            echo $m->person->first_name;
            echo $m->person->last_name;
        }*/
        return view('medrec.index')->with('medical_backgrounds', $medrec)->with('members', $members);
    }
    //evac history
    public function viewHist($id){
        //$evac = Household::select('id')->where('user_id', Auth::id())->first();
        // $evac = Evacuation::with('household_evacs.household_member.person')->where('id', $id)->get();
        $house_evac = HouseholdEvac::with('household_member.person')->where('evacuation_id',$id)->get();
        // var_dump($house_evacs);
        return view('evacuate.viewEvacuation')->with('evac',$house_evac);
    }

    public function create($household_member_id){
        //$household = Household::select('id')->where('user_id', Auth::id())->first();
        $member = HouseholdMember::find($household_member_id);
        return view('medrec.create')->with('member', $member);
    } 

    public function edit(Request $request, $id){
        $medrec = MedicalBackground::find($id);
        return view('medrec.edit')->with('medical_backgrounds', $medrec);
    }

    public function evacHistory(){
        $evacs = Evacuation::withCount(['household_evacs' => function ($buang){
            $buang->where("center_id", '<>', NULL);
        }])->get(); //ako ni ilisdan nya - Clem
        return view('evacuate.history')->with('evacs', $evacs);
    }

    public function statusView(){
        // Successfully updated at 10/13/18 7:14 PM - CLEM
        $current_evac = Evacuation::select('id')
                        ->where('status', '=', 'Ongoing')
                        ->orderBy('id', 'desc')
                        ->first();
        $house_evacs = HouseholdEvac::with(['evacuation', 'center', 'household_member.person'])
                        ->whereHas('household_member', function($query){
                            $query->where('house_id', Auth::user()->household->id);
                        })
                        ->where('evacuation_id', $current_evac->id)
                        ->get();
        return view('evacuate.index')->with('stats', $house_evacs); 
    }

    public function viewCenters(){
        $centers = Center::where('brgy_id', Auth::user()->center->brgy_id)
                            ->where('user_id', '<>', Auth::user()->id)
                            ->get();
        /*foreach($centers as $c){
            echo $c->address;
        }*/
        //echo Auth::user()->center->address;
        $evac = Evacuation::orderBy('id', 'desc')->first();
        //var_dump($evac);
        return view('evacuate.allCenters')->with('centers', $centers)->with('evac', $evac);
    }
    
    public function viewMember($id){
        $member = HouseholdMember::find($id);
        $medrec = MedicalBackground::where('household_member_id', $member->id)->get();
        return view('household.view')->with('medical_backgrounds', $medrec)->with('household_member', $member);
        
    }

    public function addAid(){
        return view('aidworker.add');
    }

    public function viewAid(){
        $aid = AidWorker::all();
        return view('aidworker.view')->with('aid', $aid);
    }

    public function editAid(Request $request, $id){
        $aid = AidWorker::find($id);
        $centers = Center::where('brgy_id', Auth::user()->center->brgy_id)->get();
        return view('aidworker.edit')->with('aid', $aid)->with('centers', $centers);
    }
    
    /* additional */
    public function createCenter(){
        return view('evacuation.add');
    }

    /*first testing for view inventory module*/
    public function viewInventory(){
        $inv = Inventory::where('center_id', Auth::user()->center->id)->get(); 
        return view('inventory.view')->with('inv', $inv);
    }

    /* 9-28-18  edit_status_report*/
    public function editStats(Request $request, $id){
        $stats = HouseholdEvac::find($id);
        return view('evacuate.edit')->with('stats', $stats);
    }

        //start of kamandag
    public function requestAid(){
        $center = Center::select('id')->where('user_id', Auth::id())->first();
        return view('aidworker.request')->with('center_id', $center);
    }

    public function viewRequest(){
        $center = Center::select('id')->where('user_id', Auth::id())->first();
        $aidreq = WorkerRequest::where('center_id', $center->id)->get();
        return view('aidworker.viewreq')->with('aidreq', $aidreq);
    }

    public function requestItems(){
        //$center = Center::select('user_id')->where('user_id', Auth::id())->first();
        //$items = Item::all();
        $reqForms = ItemRequestForm::where('user_id', Auth::id())->get();
       // var_dump($reqForms);
        return view('relief.reqitems')->with('request', $reqForms);
    }
//kamandag change 10-25
    public function viewAidHere(){
        $center = Center::select('id')->where('user_id', Auth::id())->first();
        $aidworker = AidWorkerAssignment::where('center_id', $center->id)
                                        ->where('status', '<>', 'Transferred')->get();
        return view('aidworker.viewhere')->with('worker', $aidworker);
    }
    //end of kamandag

    /* testing pani */
   /*
   public function createAnnouncement(){
        //$household = Household::select('id')->where('user_id', Auth::id())->first();
       
        return view('announcement.create');
    } */ 

    /*  kani ang back up function para view sa create announcement */
    public function createAnnouncement(){
        $center = Center::select('id')->where('user_id', Auth::id())->first();
        $announce = Announcement::all();
        return view('announcement.create')->with('center', $center)->with('announce', $announce);
    } 

    public function viewRelief(){
        return view('relief.view');
    }

     // 10-14-18 
    
     //!!!!!!! START !!!!!!!!
     public function manageAid(){
        $delete = WorkerRequest::where('num_staff_needed', 0)->delete();
        $aidRequests = WorkerRequest::all();
        $aidworkerEnRoute = AidWorkerAssignment::where('status', 'En Route')->get();
        return view('aidworker.manage')->with('aidRequests', $aidRequests)->with('aidworkerEnRoute', $aidworkerEnRoute);
    }

    public function viewPending(){
    //
    }

    //10-16-2018
    public function lists($id){
        $requestlist = WorkerRequest::find($id);
        $centerid = WorkerRequest::select('center_id')->where('id', $id)->first();
        return view('aidworker.lists')->with('requestlist', $requestlist)->with('centerid', $centerid);
    }
    //!!!!!!! END !!!!!!!!


    //10-19
    public function incoming(){
        $center = Center::select('id')->where('user_id', Auth::id())->first();
        $incomingItems = ReliefOperation::where('dest_center_id', $center->id)->get();

        return view('relief.incoming')->with('incomingItems', $incomingItems);
    }
    
    public function ViewRequestItemsForm($id){
        //$list = ItemRequestList::with('item')->where('item_request_form_id', $id)->get();
        $req = ItemRequestForm::find($id);
        //var_dump($req);
        return view('relief.viewReq')->with('request', $req);
    }

//11-4-2018 START
    /* no back end yet */
    public function accountSettingsPage(){
        $user = User::find(auth()->user()->id);
        $userHouse = Household::where('user_id', Auth::user()->id)->first();
        
        return view('account.settings')->with('user', $user)->with('userHouse', $userHouse);
    }

    // 10-10-18 kamandag
    public function evacHere(){
        $lastEvac = Evacuation::select('id')->orderBy('id','desc')->first();
        $hasEvac = HouseholdEvac::where('evacuation_id', $lastEvac->id)->get();
        
        return view('evacuate.evacuateHere')->with('hasEvac', $hasEvac);
    }
    
    #the king
    public function editCurrentItem(Request $request, $id){
        $item_list = ItemRequestList::find($id);
        return view('relief.editItem')->with('item_list', $item_list);
    }

    // scott codes
    public function viewEvac(Request $request, $id){
        $evacuee = HouseholdEvac::select('*')->where('center_id','!=',NULL) ->where('evacuation_id',$id)->get();
        return view('evacuate.viewEvac')->with('evacuee', $evacuee);
    }

    #the king
    public function viewAnnouncement($id){
       // $center = Center::select('id')->where('user_id', Auth::id())->first();
       // $announce = Announcement::where('center_id', $center->id)->get();
        $announce = Announcement::find($id);
        return view('announcement.view')->with('announce', $announce);
    }

    #the king
    public function editAnnouncement(Request $request, $id){
        $announce = Announcement::find($id);
        return view('announcement.edit')->with('announce', $announce);
    }

    // scott codes
    public function viewPop(Request $request, $id){
        $evacid = Evacuation::where('status','Ongoing')->orderBy('id', 'desc')->first();
        $center = Center::find($id);
        $house_evac = HouseholdEvac::with('household_member.person')->where('center_id', $id)->where('evacuation_id', $evacid->id)->get();
        $inventory = Inventory::with('item')->where('center_id', $id)->get();
        /*
        foreach($inventory as $i){
            echo $i->item->name;
        }*/
        return view('evacuation.viewpop')->with('center', $center)->with('inventory', $inventory)->with('house_evac', $house_evac);
    }

    // cmd center, views all registered relief operation
    public function viewAllRelief(){
        //return view('relief.view');
        $ops = ReliefOperation::where('donor', null)->where('sender_id', Auth::user()->center->id)->get();
    	return view('relief.allOperations')->with('ops', $ops);
    }

    // cmd center: view the relief operation selected
    public function viewReliefOperation($op_id){
        $reliefOperation = ReliefOperation::find($op_id);
        $evacid = Evacuation::where('status','Ongoing')->orderBy('id', 'desc')->first();
        $reliefPackage = ReliefPackage::with('item')->where('relief_operation_id', $op_id)->get();
        // $population = HouseholdEvac::where('center_id', $reliefOperation->dest_center_id)->where('evacuation_id', $evacid->id)->count();
        $centers = Center::where('brgy_id', Auth::user()->center->brgy_id)->count();
        $centers -= 1; //minus one kay apil man ang command center ani gud
        
        // testing purposes if like daghan ug population
        $population = 250;
        
        return view('relief.viewOperation')
                ->with('reliefOperation', $reliefOperation)
                ->with('package', $reliefPackage)
                ->with('center_count', $centers)
                ->with('population', $population);
    }

    public function viewDonations(){
        // get all relief ops that belong to this center and also have a donor
        $donations = ReliefOperation::where('dest_center_id', Auth::user()->center->id)->where('donor', '<>', NULL)->get();
    	return view('inventory.donation')->with('donations', $donations);
    }

    public function viewSelectedDonation($id){
        $donation = ReliefOperation::find($id);
        $package = ReliefPackage::with('item')->where('relief_operation_id', $id)->get();
        return view('inventory.viewDonation')->with('donation', $donation)->with('package', $package);
    }    

    public function editPackagePage($package_id){
        $package = ReliefPackage::find($package_id);
        return view('relief.editPackage')->with('package', $package);
    }

    // public function sms(){
    //     return view('evacuation.sms');
    // }

   //new coooooooooooooooooooooooooooooooode Scott //oct 31
   public function map(){
    $location = Center::All();      
    $pop1 = DB::table('household_evacs')
             ->select('center_id', DB::raw('count(*) as total'))
             ->groupBy('center_id')
             ->get();
    $brgy = Auth::user()->household->brgy_id;
    $pop = [];    
    foreach($pop1 as $p){
        $id = $p->center_id;
        $total = $p->total;
        $pop[] = ['id' => $id,'total' => $total];
    }

    // var_dump($pop);
    // echo $brgy;
    return view('evacuation.maps')->with('location', $location)->with('pop', $pop)->with('brgy' , $brgy);
}




    public function evacueeEdit($id){
        $evacs = HouseholdEvac::find($id);
        $medical = MedicalBackground::where('household_member_id', $evacs->household_member_id)->get(); 
        $addMed = HouseholdEvac::where('id', $id)->first();
        return view('evacuate.evacueeEdit')->with('evacs', $evacs)->with('medical', $medical)->with('addMed', $addMed);
    }

    public function evacueeUpdate($evac_id, $id){
        $medrec = MedicalBackground::find($id);
        return view('evacuate.editevacueeMed')->with('medical_backgrounds', $medrec)->with('evac_id', $evac_id);
    }

    public function evacueemedAdd($id){
        $addMed = HouseholdEvac::where('id', $id)->first();
        return view('evacuate.addevacueeMed')->with('addMed', $addMed);
    }

    public function updateDonationPackagePage($id){
        $donation = ReliefPackage::find($id);   
        return view('inventory.EditDonationItem')->with('donation', $donation);
    }

    public function cmdViewItemRequests(){
        $item_requests = ItemRequestForm::all();
        return view('relief.cmdViewItemRequests')->with('requests', $item_requests);
    }

    public function cmdOpenRequest($request_id){
        $itemRequest = ItemRequestForm::with(['user.center','item_request_lists.item'])->where('id', $request_id)->first();
        return view('relief.cmdOpenRequest')->with('request', $itemRequest);
    }

    // public function sendsms(){
    //     $numbers = Person::select('mobile_num')->where('mobile_num','!=','NULL')->get();
    //     return view('evacuation.sms')->with('numbers',$numbers);
    // }

    public function writesms(){
        $people = Person::select('mobile_num', 'first_name', 'middle_name', 'last_name')->where('mobile_num', '<>', '')->get();
        return view('evacuation.writesms')->with('people', $people);
    }

    public function viewSelecetedAidWorker($worker_id){
        //$worker = AidWorker::with('aid_worker_assignment')->where('id', $worker_id)->get();
        $worker = AidWorker::find($worker_id);
        $assignments = AidWorkerAssignment::where('aid_worker_id', $worker_id)->orderBy('id', 'desc')->get();
        return view('aidworker.viewSelected')->with('worker', $worker)->with('assignments', $assignments);
    }


    public function incomingAid(){
        $center = Center::select('id')->where('user_id', Auth::id())->first();
        $aidworker = AidWorkerAssignment::where('center_id', $center->id)
                                        ->where('status', 'En Route')->get();
        return view('aidworker.incomingaid')->with('incoming', $aidworker);
    }

    public function peopleEvacuated(){
        $lastEvac = Evacuation::select('id')->where('status','Ongoing')->orderBy('id','desc')->first();
        $household_evac = HouseholdEvac::where('evacuation_id', $lastEvac->id)->get();
        
        return view('evacuation.peopleEvacuated')->with('household_evac', $household_evac);
    }

    public function peopleMissing(){
        $lastEvac = Evacuation::select('id')->where('status','Ongoing')->orderBy('id','desc')->first();
        $household_evac = HouseholdEvac::where('evacuation_id', $lastEvac->id)->get();
        
        return view('evacuation.peopleMissing')->with('household_evac', $household_evac);
    }

    public function peopleSick(){
        $lastEvac = Evacuation::select('id')->where('status','Ongoing')->orderBy('id','desc')->first();
        $household_evac = HouseholdEvac::where('evacuation_id', $lastEvac->id)->get();
        return view('evacuation.peopleSick')->with('household_evac', $household_evac);
    }

    public function peopleDeceased(){
        $lastEvac = Evacuation::select('id')->where('status','Ongoing')->orderBy('id','desc')->first();
        $household_evac = HouseholdEvac::where('evacuation_id', $lastEvac->id)->get();
        
        return view('evacuation.peopleDeceased')->with('household_evac', $household_evac);
    }

    public function reactivate(){
        $allDeac = Household::all();
        return view('account.reactivate')->with('allDeac', $allDeac);
    }
}
