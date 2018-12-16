<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AidWorkerAssignment extends Model
{
    protected $table = "aid_worker_assignments";
    public $primaryKey = "id";
    public $timestamps = true;

    public function aid_worker(){
        return $this->belongsTo('App\AidWorker', 'aid_worker_id');
    }

    public function center(){
        return $this->belongsTo('App\Center', 'center_id');
    }
}
