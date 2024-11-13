<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProcessType;
use input;

class ProcessTypeController extends Controller
{
    /*
    | Page Redirection - Office/Create
    */
    Public function create(){
        $processtypes = ProcessType::all();
    	return view('processtype.create',compact('processtypes'));

    }
    
    /*
    | Store - Offices
    */
    Public function store(Request $request){
        $input = $request->input('name');
        $ucword = ucwords($input);
    	$data = new ProcessType;    	
    	$data->name = $ucword; 
    	$data->save();
    	flash('Recorded Successfully!')->success();
    	return back()->withInput();
    }

    /*
    | Edit - Offices
    */
    Public function edit($id){
        $processtypes = ProcessType::findOrFail($id);
        return view('processtype.edit', compact('processtypes'));
    }

    /*
    | Update - Offices
    */
    Public function update(Request $request, $id){
        $input = $request->input('name');
        $ucword = ucwords($input);
        $data = ProcessType::findOrFail($id);     
        $data->name = $ucword; 
        $data->save();
        flash('Updated Successfully!')->success();
        return back()->withInput();
    }   
}
