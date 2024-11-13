<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrDescription;
use input;

class PrDescriptionController extends Controller
{
    /*
    | Page Redirection - Office/Create
    */
    Public function create(){
        $prdescriptions = PrDescription::all();
    	return view('prdescription.create',compact('prdescriptions'));

    }
    
    /*
    | Store - Offices
    */
    Public function store(Request $request){
        $input = $request->input('name');
        $ucword = ucwords($input);
    	$data = new PrDescription;    	
    	$data->name = $ucword; 
    	$data->save();
    	flash('Recorded Successfully!')->success();
    	return back()->withInput();
    }

    /*
    | Edit - Offices
    */
    Public function edit($id){
        $prdescriptions = PrDescription::findOrFail($id);
        return view('prdescription.edit', compact('prdescriptions'));
    }

    /*
    | Update - Offices
    */
    Public function update(Request $request, $id){
        $input = $request->input('name');
        $ucword = ucwords($input);
        $data = PrDescription::findOrFail($id);     
        $data->name = $ucword; 
        $data->save();
        flash('Updated Successfully!')->success();
        return back()->withInput();
    }   
}
