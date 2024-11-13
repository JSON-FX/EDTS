<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Endorsement;
use App\Event;

class ActionTaken extends Model
{
    protected $fillable = ['name'];

    public function endorsements(){
        return $this->hasMany('App\Endorsement');
    }
}
