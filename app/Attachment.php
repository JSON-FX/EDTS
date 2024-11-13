<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;
use App\Endorsement;
use App\AttachmentList;

class Attachment extends Model
{
    protected $fillable = [
        'transactions_id',
        'endorsements_id',
    	'attachment_lists_id',
    	'reference_id',
    ];


    public function transactions(){
        return $this->belongsTo('App\Transaction', 'transactions_id');
    }

    public function endorsements(){
        return $this->belongsTo('App\Endorsement', 'endorsements_id');
    }

    public function attachments_lists(){
        return $this->belongsTo('App\AttachmentList', 'attachment_lists_id');
    }
}
