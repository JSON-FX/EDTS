<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;
use App\ProcessType;
use App\Office;
use App\EndorsingOffice;
use App\ReceivingOffice;
use App\PrDescription;
use App\Status;
use App\Event;
use App\Attachment;
use App\ActionTaken;
use App\User;

class Endorsement extends Model
{
    protected $fillable = [
    	'transactions_id',
        'endorsing_offices_id',
        'receiving_offices_id',
        'date_endorsed',
        'date_received',
        'statuses_id',
        'action_takens_id',
        'users_id',
        'receivingstaff_id'
    ];


     public function transactions(){
        return $this->belongsTo('App\Transaction', 'transactions_id');
    }
    
    public function endorsing_offices(){
        return $this->belongsTo('App\EndorsingOffice', 'endorsing_offices_id');
    }

    public function receiving_offices(){
        return $this->belongsTo('App\ReceivingOffice', 'receiving_offices_id');
    }

    public function statuses(){
        return $this->belongsTo('App\Status', 'statuses_id');
    }

    public function events(){
        return $this->hasMany('App\Event');
    }

    public function attachments(){
        return $this->hasMany('App\Attachment');
    }

    public function actiontaken(){
        return $this->belongsTo('App\ActionTaken', 'action_takens_id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'users_id');
    }
   
    public function receivingstaffs(){
        return $this->belongsTo('App\User', 'receivingstaff_id');
    }
}
