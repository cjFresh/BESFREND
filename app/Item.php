<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{   
    protected $table = "items";
    public $primaryKey = "id";
    public $timestamps = true;

    public function item_request_list(){
        return $this->hasMany('App\ItemRequestList');
    }

    public function inventory(){
        return $this->hasMany('App\Inventory');
    }

    public function relief_packages(){
        return $this->hasMany('App\ReliefPackage');
    }
}
