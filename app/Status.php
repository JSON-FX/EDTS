<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;
use App\AccountingProcess;
use App\BacProcess;
use App\BudgetProcess;
use App\GsoProcess;
use App\MmoProcess;
use App\MtoProcess;
use App\Endorsement;
use App\MisProcess;

class Status extends Model
{
   protected $fillable = ['name'];


    public function transactions(){
        return $this->hasMany('App\Transaction');
    }

    public function mis_processess(){
        return $this->hasMany('App\MisProcess');
    }

    public function accounting_processes(){
        return $this->hasMany('App\AccountingProcess');
    }

    public function bac_processes(){
        return $this->hasMany('App\BacProcess');
    }

    public function budget_processes(){
        return $this->hasMany('App\BudgetProcess');
    }

    public function gso_processes(){
        return $this->hasMany('App\GsoProcess');
    }

    public function mmo_processes(){
        return $this->hasMany('App\MmoProcess');
    }

    public function mto_processes(){
        return $this->hasMany('App\MtoProcess');
    }

    public function endorsements(){
        return $this->hasMany('App\Endorsement');
    }

}
