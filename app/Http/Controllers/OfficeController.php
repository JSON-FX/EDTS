<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Office;
use input;

class OfficeController extends Controller
{
    /*
    | Page Redirection - Office/Create
    */
    Public function create(){
        $offices = Office::all();
    	return view('office.create',compact('offices'));

    }
    
    /*
    | Store - Offices
    */
    Public function store(Request $request){
        $input = $request->input('name');
        $ucword = ucwords($input);
    	$data = new Office;    	
    	$data->name = $ucword; 
    	$data->save();
    	flash('Recorded Successfully!')->success();
    	return back()->withInput();
    }

    /*
    | Edit - Offices
    */
    Public function edit($id){
        $offices = Office::findOrFail($id);
        return view('office.edit', compact('offices'));
    }

    /*
    | Update - Offices
    */
    Public function update(Request $request, $id){
        $input = $request->input('name');
        $ucword = ucwords($input);
        $data = Office::findOrFail($id);     
        $data->name = $ucword; 
        $data->save();
        flash('Updated Successfully!')->success();
        return back()->withInput();
    }
}
