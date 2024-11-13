<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
use App\User;

class EventUpdate extends Model
{
    protected $fillable = ['events_id', 'users_id', 'datetime', 'report'];   

    public function events(){
        return $this->BelongsTo('App\Event', 'events_id');
    }

    public function users(){
    	return $this->BelongsTo('App\User', 'users_id');
    }
}
