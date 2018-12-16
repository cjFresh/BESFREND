<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function item(){
        return $this->belongsTo('App\Item', 'item_id');
    }
    public function center(){
        return $this->belongsTo('App\Center', 'center_id');
    }
}
