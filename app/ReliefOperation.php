<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReliefOperation extends Model
{
    protected $table = "relief_operations";
    public $primaryKey = "id";
    public $timestamps = true;

    public function center(){
        return $this->belongsTo('App\Center', 'dest_center_id');
    }

    public function relief_packages(){
        return $this->hasMany('App\ReliefPackage');
    }
    
    public function sender(){
        return $this->belongsTo('App\Center', 'sender_id');
    }
    
}
