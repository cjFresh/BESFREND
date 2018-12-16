<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalBackground extends Model
{
    protected $table = "medical_backgrounds";
    public $primaryKey = "id";
    public $timestamps = true;

    public function household_member(){
        return $this->belongsTo('App\HouseholdMember', 'household_member_id');
    }
}
