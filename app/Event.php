<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;
use App\Office;
use App\Endorsement;
use App\EventUpdate;
use App\User;

class Event extends Model
{
    protected $fillable = ['transactions_id', 'endorsements_id', 'users_id', 'report'];

    public function users(){
        return $this->belongsTo('App\User', 'users_id');
    }

    public function transactions(){
        return $this->belongsTo('App\Transaction', 'transactions_id');
    }

    public function endorsements(){
        return $this->belongsTo('App\Endorsement', 'endorsements_id');
    }

    public function eventupdates(){
        return $this->HasMany('App\EventUpdate');
    }
}
