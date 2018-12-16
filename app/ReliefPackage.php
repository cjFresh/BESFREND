<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReliefPackage extends Model
{
    protected $table = "relief_packages";
    public $primaryKey = "id";
    public $timestamps = true;

    public function relief_operations(){
        return $this->belongsTo('App\ReliefOperation', 'relief_operation_id');
    }

    public function item(){
        return $this->belongsTo('App\Item', 'item_id');
    }
}
