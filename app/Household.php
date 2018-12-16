<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    protected $table = "households";
    public $primaryKey = "id";
    public $timestamps = true;

    public function household_member(){
        return $this->hasMany('App\HouseholdMember'); //changed
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function barangay(){
        return $this->belongsTo('App\Barangay', 'brgy_id');
    }
}

