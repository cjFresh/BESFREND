<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evacuation extends Model
{
    protected $table = "evacuations";
    public $primaryKey = "id";
    public $timestamps = true;
    
    public function household_evacs(){
        return $this->hasMany('App\HouseholdEvac'); // I made this - Clem
    }

    public function barangay(){
        return $this->belongsTo('App\Barangay', 'brgy_id'); // I made this - Clem
    }
}
