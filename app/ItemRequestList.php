<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemRequestList extends Model
{
    protected $table = "item_request_lists";
    public $primaryKey = "id";
    public $timestamps = true;

    public function item(){
        return $this->belongsTo('App\Item');
    }

    public function item_request_form(){
        return $this->belongsTo('App\ItemRequestForm', 'item_request_form_id');
    }
}
