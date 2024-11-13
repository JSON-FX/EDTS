<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class Canvasser extends Model
{
   protected $fillable = ['name'];

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
}
