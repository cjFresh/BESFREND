<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table = "centers";
    public $primaryKey = "id";
    public $timestamps = true;
    
    /*
    public function household_members(){
        return $this->hasOne('App\HouseholdMember'); // I think I changed this - Clem
    }*/

    public function barangay(){
        return $this->belongsTo('App\Barangay', 'brgy_id'); // I think I changed this - Clem
    }

    public function HouseholdEvac(){
        return $this->hasMany('App\HouseholdEvac');
    }

    public function user(){
        return $this->belongsTo('App\User'); // I think I changed this - Clem
    }

  /*  public function aidworkers(){
        return $this->hasOne('App\AidWorker');
    } */

    public function inventory(){
        return $this->hasMany('App\Inventory');
    }

    public function WorkerRequest(){
        return $this->hasOne('App\WorkerRequest');
    }
    
    public function aid_workers(){
        return $this->hasOne('App\AidWorker');
    }

    /* trial and error */
    public function announcement(){
        return $this->belongsTo('App\Announcement', 'center_id');
    }

    public function reliefOperation(){
        return $this->hasMany('App\ReliefOperation');
    }

    
    public function reliefOperationtwo(){
        return $this->hasMany('App\ReliefOperation');
    } 
}
