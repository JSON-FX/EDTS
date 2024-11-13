<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Endorsement;

class EndorsingOffice extends Model
{
    protected $fillable = ['name', 'abbr'];

    public function endorsements(){
    	return $this->HasMany('App\Endorsement');
    }
}
