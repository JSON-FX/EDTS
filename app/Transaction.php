<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProcessType;
use App\Office;
use App\PrDescription;
use App\Status;
use App\Endorsement;
use App\Event;
use App\Attachment;
use App\AttachmentList;
use App\User;
use App\Canvasser;

class Transaction extends Model
{
    protected $fillable = [
        'date_of_entry',
        'reference_id',
        'sub_reference_id',
        'description',
        'process_types_id',
        'offices_id',
        'pr_descriptions_id',
        'reference_id',
        'amount',
        'pr_actual_amount',
        'client',
        'address',
        'canvassers_id',
        'statuses_id',
        'endorsement_date',
        'users_id'
    ];

    public function offices(){
        return $this->belongsTo('App\Office', 'offices_id');
    }

    public function process_types(){
        return $this->belongsTo('App\ProcessType', 'process_types_id');
    }

    public function pr_descriptions(){
        return $this->belongsTo('App\PrDescription', 'pr_descriptions_id');
    }

    public function statuses(){
        return $this->belongsTo('App\Status', 'statuses_id');
    }

    public function endorsements(){
        return $this->hasMany('App\Endorsement');
    }

    public function events(){
        return $this->hasMany('App\Event');
    }

    public function attachments(){
        return $this->hasMany('App\Attachment');
    }

    public function attachment_lists(){
        return $this->hasMany('App\AttachmentList');
    }

    public function users(){
        return $this->belongsTo('App\User', 'users_id');
    }

    public function canvassers(){
        return $this->belongsTo('App\Canvasser', 'canvassers_id');
    }


}
