<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdEvac extends Model
{
    protected $table = "household_evacs";
    protected $fillable = ['evacuation_id', 'status', 'whereabouts', 'remarks'];
    public $primaryKey = "id";
    public $timestamps = true;

    public function household_member(){
        return $this->belongsTo('App\HouseholdMember', 'household_member_id');
    }

    public function center(){
        return $this->belongsTo('App\Center', 'center_id');
    }

    public function evacuation(){
        return $this->belongsTo('App\Evacuation', 'evacuation_id');
    }
}
