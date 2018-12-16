<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerRequest extends Model
{   
    protected $table = "worker_requests";
    public $primaryKey = "id";
    public $timestamps = false;
    
    public function centers(){
        return $this->belongsTo('App\Center', 'center_id');
    }
}
