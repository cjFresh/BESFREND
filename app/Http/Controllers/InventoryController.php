<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Center;
use App\Inventory;
use App\ReliefOperation;
use App\ReliefPackage;
use App\Item;
use Auth;
use Carbon;
use DB;

class InventoryController extends Controller
{   
    /*naay sayop sa update idk why */
    public function update(Request $request, $id){
        $inv = Inventory::find($id);
        $inv->qty_left = $request->qty_left;
        $inv->save();
        return redirect('/viewInventory')->with('success', 'Quantity of '.$inv->item->name.' is successfully updated!');
    }

    //record a donation made to the currently logged in center
    public function newDonation(Request $request){
        $validate = $request->validate([
            'name'              => 'required',
            'donor'             => 'required'
        ]);

        date_default_timezone_set('Asia/Singapore');
        $donation = new ReliefOperation;
        $donation->name = $request->name;
        $donation->donor = $request->donor;
        $donation->confirmation = "Encoding";
        $donation->dest_center_id = Auth::user()->center->id;
        $mytime = Carbon\Carbon::now();
        $donation->save();
        return redirect('/viewSelectedDonation/'.$donation->id);
    }
   
    public function addItemDonation(Request $request, $op_id){
        date_default_timezone_set('Asia/Singapore');
        //$reqForm = ItemRequestForm::find($request_form_id);
        $package = new ReliefPackage;
        $mytime = Carbon\Carbon::now();
        $package->relief_operation_id = $op_id;
        $package->qty = $request->qty;
        switch($request->choice){
            case 'new':
                $item = new Item;
                $item->name = $request->item;
                $item->type = $request->type;
                $item->unit_measurement = $request->unit;
                $item->save();
                $package->item_id = $item->id;
                break;
            case 'existing':
                $package->item_id = $request->item;
                break;
        }
        $package->save();
        //return to page where it displays the
        //info of the selected relief operation
        return redirect('/viewSelectedDonation/'.$op_id)->with('success', "New item added to the list of donated items.");
    }

    public function removeItemDonationPackage($package_id, $op_id){
        $package = ReliefPackage::find($package_id);
        $item = $package->item->name;
        $package->delete();
        return redirect('/viewSelectedDonation/'.$op_id)->with('success', $item.' has been removed from the list of donated items.');
    }

    public function updateDonationPackage($id, Request $request){
        $donation = ReliefPackage::find($id);
        $donation->qty = $request->qty;
        $donation->save();
        return redirect('/viewSelectedDonation/'.$donation->relief_operation_id)->with('success', "Successfully edited ".$donation->item->name."'s quantity.");
    }

    public function addPackageItemsToInventory($op_id){
        date_default_timezone_set('Asia/Singapore');
        $packages = ReliefPackage::where('relief_operation_id', $op_id)->get();
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
        $relief_op = ReliefOperation::find($op_id);
        $relief_op->confirmation = "Arrived";
        $relief_op->save();
        
        return redirect('/viewInventory')->with('success', "Items from the donation are added to the inventory!");
    }

    public function addItemToInventory(Request $request){
        date_default_timezone_set('Asia/Singapore');
        $inventory = new Inventory;
        $mytime = Carbon\Carbon::now();
        $inventory->center_id = Auth::user()->center->id;
        $inventory->qty_left = $request->qty;
        switch($request->choice){
            case 'new':
                $item = new Item;
                $item->name = $request->item;
                $item->type = $request->type;
                $item->unit_measurement = $request->unit;
                $item->save();
                $inventory->item_id = $item->id;
                break;
            case 'existing':
                $inventory->item_id = $request->item;
                break;
        }
        $inventory->save();
        return redirect('/viewInventory')->with('success', "New item added to the inventory!");
    }

    public function deleteDonation($id){
        $deletePackage = ReliefPackage::where('relief_operation_id', $id)->delete();
        $deleteOps = ReliefOperation::find($id);
        $name = $deleteOps->name;
        $deleteOps->delete();
        return redirect('viewDonations')->with('success', "Donation $name has been deleted!");
    }
}
