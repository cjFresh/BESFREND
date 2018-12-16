<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdMember extends Model
{
    protected $table = "household_members";
    public $primaryKey = "id";
    public $timestamps = true;

    public function person(){
        return $this->belongsTo('App\Person', 'person_id');
    }

    public function medical_background(){
        return $this->hasMany('App\MedicalBackground');
    }

    /*public function center(){
        return $this->belongsTo('App\Center'); // I think I changed this - Clem
    }*/ 

    public function household_evac(){
        return $this->hasMany('App\HouseholdEvac', 'household_member_id');
    }

    public function household(){
        return $this->belongsTo('App\Household', 'house_id'); // I think I changed this - Clem
    }
}
