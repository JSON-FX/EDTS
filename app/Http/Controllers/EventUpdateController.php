<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Event;
use Carbon\Carbon;
use App\Attachment;
use App\AttachmentList;
use DB;
use App\EventUpdate;
use Input;
use App\ActionTaken;

class EventUpdateController extends Controller
{
    public function create ($id){
        $events = Event::WhereIn('id', [$id])->first();
        $actions = ActionTaken::all();
        return view('eventupdate.create', compact('events', 'actions'));
    }

    public function store (Request $request, $id){
        $date = $request->input('date_of_entry');
        $report = $request->input('report');

        $event = Event::where('id', '=', $id)->first();
        $events = new EventUpdate;
        $events->events_id = $event->id;
        $events->users_id = auth()->user()->id;
        $events->datetime = $date;
        $events->report = $report;
        $events->save();

        flash('Updated Successfully!')->success();
        return back()->withInput();
    }

    public function delete($id){
        // $events = Event::WhereIn('id', [$id])->first();
        $data = EventUpdate::where('id', '=', $id)->first();
        $data->delete();

        flash('Update has been removed')->error();
        return back()->withInput();
    }

}
