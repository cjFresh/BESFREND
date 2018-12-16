<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = "barangays";
    public $primaryKey = "id";
    public $timestamps = true;

    public function center(){
        return $this->hasMany('App\Center'); // I think I changed this - Clem
    }

    public function households(){
        return $this->hasMany('App\Household', 'brgy_id'); // I think I changed this - Clem
    }

    public function evacuations(){
        return $this->hasMany('App\Evacuations'); // I made this -Clem
    }
}
