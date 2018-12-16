<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemRequestForm extends Model
{
    protected $table = "item_request_forms";
    public $primaryKey = "id";
    public $timestamps = true;

    public function item_request_lists(){
        return $this->hasMany('App\ItemRequestList');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
