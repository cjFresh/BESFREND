<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\ItemRequestList;
use App\ItemRequestForm;
use App\Item;
use App\Barangay;
use Auth;
use App\Center;
use App\ReliefOperation;
use App\ReliefPackage;
use App\Inventory;
use DB;

class ReliefController extends Controller
{
    public function relief(){
        if(!Auth::user()){
            $type = Barangay::all();
            return view('pages.welcome')->with('brgy', $brgy);
        }
    }

    public function requestForm(Request $request){
        date_default_timezone_set('Asia/Singapore');
        $mytime = Carbon\Carbon::now();
        $reqItem = new ItemRequestForm;
        $reqItem->user_id = Auth::user()->id;
        $reqItem->reasons = $request->reason;
        $reqItem->status = "Encoding";
        $reqItem->final_remarks = NULL;
        //var_dump($reqItem);
        $reqItem->save();
        //echo "<h1>".$reqItem->center_id."</h1>";
        //echo "Hello";
        return redirect('/ViewRequestItemsForm/'.$reqItem->id);
    }
    
    public function deleteRequestItemForm($id){
        $lsitItems = ItemRequestList::where('item_request_form_id', $id)->delete();
        $reqItem = ItemRequestForm::find($id)->delete();
        return redirect('/requestItems');
        
    }

    public function submitRequestItemForm($id){
        $reqItem = ItemRequestForm::find($id);
        $reqItem->status = "Pending";
        $reqItem->save();
        return redirect('/requestItems');
    }

    public function requestSelectNewItem($request_form_id, Request $request){
        date_default_timezone_set('Asia/Singapore');
        //$reqForm = ItemRequestForm::find($request_form_id);
        switch($request->choice){
            case 'new':
                $mytime = Carbon\Carbon::now();
                $item = new Item;
                $item->name = $request->item;
                $item->type = $request->type;
                $item->unit_measurement = $request->unit;
                $item->save();
                $list = new ItemRequestList;
                $list->item_request_form_id = $request_form_id; // EDITED JUST NOW
                $list->item_id = $item->id;
                $list->qty_requested = $request->qty;
                $list->priority_level = $request->priority;
                $list->save();
                break;
            case 'existing':
                $mytime = Carbon\Carbon::now();
                $list = new ItemRequestList;
                $list->item_request_form_id = $request_form_id; // EDITED JUST NOW
                $list->item_id = $request->item;
                $list->qty_requested = $request->qty;
                $list->priority_level = $request->priority;
                $list->save();
                break;
        }
        return redirect('/ViewRequestItemsForm/'.$request_form_id);
    }

    public function updateCurrentItem(Request $request, $item_request_form_id){
        $item_request_list = ItemRequestList::find($item_request_form_id);
        $item_request_list->qty_requested = $request->qty_requested;
        $item_request_list->priority_level = $request->priority_level;
        $item_request_list->save();

        /* tempo rani ang redirect kay diko kahibaw unsaon tong mo redirect siya sa list of items */
        // return redirect('/requestItems');
        /* original redirection unta */ 
        return redirect('/ViewRequestItemsForm/'.$item_request_list->item_request_form_id);
        // var_dump($item_request_list);
    }

    public function newReliefOperation(Request $request){
    	date_default_timezone_set('Asia/Singapore');
        $newOp = new ReliefOperation;
        $mytime = Carbon\Carbon::now();
    	$newOp->name = $request->name;
        $newOp->dest_center_id = $request->dest_center_id;
        $newOp->sender_id = Auth::user()->center->id;
    	// make sure naay encoding sa enum
    	$newOp->confirmation = "Encoding";
        $newOp->save();
        return redirect('/viewReliefOperation/'.$newOp->id);
    }

    public function addItemReliefPackage($op_id, Request $request){
        date_default_timezone_set('Asia/Singapore');
        $package = new ReliefPackage;
        $mytime = Carbon\Carbon::now();
        $package->relief_operation_id = $op_id;
        $package->item_id = $request->item;
        $inv = Inventory::where('item_id', $request->item)->where('center_id', Auth::user()->center->id)->first();
        if($inv->qty_left < $request->qty){
            $package->qty = $inv->qty_left;
            $inv->qty_left -= $package->qty; // subtract from inventory
            $package->save();
            $inv->save();
            return redirect('/viewReliefOperation/'.$op_id)->with('error', 'Succesfully added item, but only '.$package->qty.' '.$inv->item->unit_measurement.' instead of the requested '.$request->qty." ($package->qty left in inventory).");
        }else{
            $package->qty = $request->qty1;
            $inv->qty_left -= $package->qty;
            $package->save();
            $inv->save();
            return redirect('/viewReliefOperation/'.$op_id)->with('success', 'Succesfully added item to the package');
        }
    }

    public function removeItemReliefPackage($package_id, $op_id){
        $package = ReliefPackage::find($package_id);
        $inventory = Inventory::where('center_id', Auth::user()->center->id)->where('item_id', $package->item_id)->first();
        $inventory->qty_left += $package->qty; // returns the items to the inventory
        $inventory->save();
        $package->delete();
        return redirect('/viewReliefOperation/'.$op_id)->with('success', 'Successfully removed an item from the package and returned it to the inventory.');
    }

    public function cancelReliefOperation($op_id){
        $reliefPackage = ReliefPackage::where('relief_operation_id', $op_id)->get();
        $inventory = Inventory::where('center_id', Auth::user()->center->id)->get();
        foreach($reliefPackage as $rp){
            foreach($inventory as $inv){
                if($rp->item_id == $inv->item_id){
                    $inv->qty_left += $rp->qty;
                    $inv->save();
                    $rp->delete();
                }
            }
        }
        $reliefOperation = ReliefOperation::find($op_id)->delete();
        return redirect('/viewAllRelief')->with('success', 'Successfully discarded the relief operation.');
    }

    public function deployReliefOperation($op_id){
        $reliefOperation = ReliefOperation::find($op_id);
        //echo $package[0]->relief_operations->name;
        $reliefOperation->confirmation = "En Route";
        $reliefOperation->save();
        return redirect('/viewReliefOperation/'.$op_id)->with('success', "The relief operation has been deployed to its designated destination.");
    }

    public function cancelReliefOpDeployment($op_id){
        $reliefOperation = ReliefOperation::find($op_id);
        switch($reliefOperation->confirmation){
            case "En Route": 
                $reliefOperation->confirmation = "Encoding";
                $reliefOperation->save();
                return redirect('/viewReliefOperation/'.$op_id)->with('success', "The deployment of the relief operation has been cancelled.");
                break;
            default:
                return redirect('/viewReliefOperation/'.$op_id)->with('error', "The relief operation is not yet deployed.");
        }
    }

    public function confirmArrival($id){
        date_default_timezone_set('Asia/Singapore');
        $packages = ReliefPackage::where('relief_operation_id', $id)->get();
        $inventory = Inventory::where('center_id', Auth::user()->center->id)->get();
        foreach($packages as $p){
            $flag = 0;
            foreach($inventory as $inv){
                if($inv->item_id == $p->item_id){
                    $flag++;
                    $inventory_id = $inv->id;
                }
            }
            switch($flag){
                case 0: //item is not in the center's inventory 
                    $new_inv = new Inventory;
                    $new_inv->center_id = Auth::user()->center->id;
                    $new_inv->item_id = $p->item_id;
                    $new_inv->qty_left = $p->qty;
                    $mytime = Carbon\Carbon::now();
                    $new_inv->save();
                    break;
                case 1: //item is already in the inventory
                    $update_inv = Inventory::find($inventory_id);
                    $update_inv->qty_left += $p->qty;
                    $mytime = Carbon\Carbon::now();
                    $update_inv->save();
                    break;
            }
        }
        $relief_op = ReliefOperation::find($id);
        $relief_op->confirmation = "Arrived";
        $relief_op->save();
        
        return redirect('/incomingRelief')->with('success', 'Successfuly Accepted!');
        
    }

    public function editItemPackage($package_id, Request $request){
        date_default_timezone_set('Asia/Singapore');
        $mytime = Carbon\Carbon::now();
        $reliefPackage = ReliefPackage::find($package_id);
        $inventory = Inventory::where('center_id', Auth::user()->center->id)->where('item_id', $reliefPackage->item_id)->first();
        if($request->qty < $reliefPackage->qty){
            $diff = $reliefPackage->qty - $request->qty;
            //echo $diff;
            $inventory->qty_left += $diff;
            //echo $inventory->qty_left;
            $reliefPackage->qty = $request->qty;
            //echo $reliefPackage->qty;
            $inventory->save();
            $reliefPackage->save();
            return redirect('/viewReliefOperation/'.$reliefPackage->relief_operation_id)->with('success', 'Updated the quantity of '.$reliefPackage->item->name.'.');
        }else if($request->qty > $reliefPackage->qty){
            //echo $reliefPackage->item->name;
            $diff = $request->qty - $reliefPackage->qty;
            //echo $diff;
            $initial_inv_count = $reliefPackage->qty + $inventory->qty_left;
            //echo $initial_inv_count;
            if($initial_inv_count < $request->qty){
                /***********************************/
                /*echo $request->qty."<br>";********/
                /*echo $inventory->qty_left."<br>";*/
                /*echo $initial_inv_count."<br>";***/
                /***********************************/
                $reliefPackage->qty += $inventory->qty_left;
                //echo $reliefPackage->qty; 
                $last_count = $inventory->qty_left;
                $inventory->qty_left = 0;
                $inventory->save();
                $reliefPackage->save();
                return redirect('/viewReliefOperation/'.$reliefPackage->relief_operation_id)->with('error', 'Depleted quantity of '.$reliefPackage->item->name.' from inventory, and only took '.$last_count.' '.$reliefPackage->item->unit_measurement.'.');
            }else if($initial_inv_count >= $request->qty){
                /*
                echo $reliefPackage->qty.'<br>';
                echo $request->qty."<br>";
                echo $inventory->qty_left."<br>";
                echo $initial_inv_count."<br>";
                echo $diff;
                */
                $reliefPackage->qty += $diff;
                //echo $reliefPackage->qty; 
                //echo $inventory->qty_left."<br>";
                $inventory->qty_left -= $diff;
                //echo $inventory->qty_left."<br>";
                $inventory->save();
                $reliefPackage->save();
                return redirect('/viewReliefOperation/'.$reliefPackage->relief_operation_id)->with('success', 'Updated the quantity of '.$reliefPackage->item->name.'.');
            }
        }else if($request->qty == $reliefPackage->qty){
            return redirect('/viewReliefOperation/'.$reliefPackage->relief_operation_id)->with('error', 'Nothing has changed for '.$reliefPackage->item->name.'.');
        }
    }

    public function cmdRequestApproval(Request $request, $id){
        $itemRequest = ItemRequestForm::find($id);
        $itemRequest->final_remarks = $request->remarks;
        $itemRequest->status = $request->choice;
        $itemRequest->save();
        switch($request->choice){
            case "Approved":
                //echo "Approved";
                date_default_timezone_set('Asia/Singapore');
                $newOp = new ReliefOperation;
                $mytime = Carbon\Carbon::now();
                $newOp->name = date('Y-m-d')." - Approved Relief Operation for ".$itemRequest->user->center->location;
                $newOp->dest_center_id = $itemRequest->user->center->id;
                $newOp->sender_id = Auth::user()->center->id;
                // make sure naay encoding sa enum
                $newOp->confirmation = "Encoding";
                $newOp->save();
                
                //PARA ANG SYSTEM NAAY MIND OF ITS OWN
                $itemList = ItemRequestList::where('item_request_form_id', $id)->get();
                foreach($itemList as $i){
                    $inv = Inventory::where('center_id', Auth::user()->center->id)->where('item_id', $i->item_id)->first();
                    if($inv){
                        $mytime = Carbon\Carbon::now();
                        $reliefPackage = new ReliefPackage;
                        $reliefPackage->relief_operation_id = $newOp->id;
                        $reliefPackage->item_id = $i->item_id;
                        if($i->qty_requested <= $inv->qty_left){
                            $reliefPackage->qty = $i->qty_requested;
                        }else{
                            $reliefPackage->qty = $inv->qty_left;
                        }
                        $reliefPackage->save();
                    }
                }
                //AFTER ANI NGA CODE NAA NAY MIND ANG SYSTEM! *skynet intensifies*
                //watch terminator to get the reference... 

                return redirect('/viewReliefOperation/'.$newOp->id)->with('success', "Items request has been approved, you may now set up the relief operation.");
                break;
            case "Denied":
                //echo "Denied";
                return redirect('/cmdViewItemRequests')->with('success', "Request has been DENIED");
                break;
        }
    }
}
