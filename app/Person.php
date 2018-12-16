<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "people";
    public $primaryKey = "id";
    public $timestamps = true;

    public function household_member(){
        return $this->hasOne('App\HouseholdMember', 'person_id');
    }

    public function aidWorker(){
        return $this->hasOne('App\AidWorker');
    }
}
