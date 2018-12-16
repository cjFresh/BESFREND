<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AidWorker extends Model
{
    protected $table = "aid_workers";
    public $primaryKey = "id";
    public $timestamps = true;

  /*  public function centers(){
        return $this->belongsTo('App\Center', 'assigned_center_id');
    }  */

    public function person(){
        return $this->belongsTo('App\Person', 'person_id');
    }

    public function center(){
        return $this->belongsTo('App\Center', 'assigned_center_id');
    }

    public function aid_worker_assignment(){
        return $this->hasMany('App\AidWorkerAssignment');
    }
}
