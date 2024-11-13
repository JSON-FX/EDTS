<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Input;
use App\ActionTaken;

class ActionTakenController extends Controller
{
    public function index(){
        $actions = ActionTaken::all();
        return view('actiontaken.index', compact('actions'));
    }

}
