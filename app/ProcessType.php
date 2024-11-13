<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class ProcessType extends Model
{
   protected $fillable = ['name'];

   public function transactions(){
        return $this->hasMany('App\Transaction');
   }
}
