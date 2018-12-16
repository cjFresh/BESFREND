<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = "announcements";
    public $primaryKey = "id";
    public $timestamps = true;
    
    /* trial and error */
    public function center(){
        return $this->hasMany('App\Center');
    }
}
