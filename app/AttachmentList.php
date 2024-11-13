<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Attachment;
use App\Transaction;

class AttachmentList extends Model
{
    protected $fillable = [
    	'name'
    ];

    public function transactions(){
        return $this->belongsTo('App\Transaction', 'transactions_id');
    }

    public function attachments(){
        return $this->hasMany('App\Attachment');
    }

}
