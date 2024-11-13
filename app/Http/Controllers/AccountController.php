<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Office;
use App\Status;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function find($id){
    	$users = User::with('offices')->findOrFail($id)->first();
    	return view('profile.find', compact('users'));
    }
}
