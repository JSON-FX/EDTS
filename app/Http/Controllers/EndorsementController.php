<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Transaction;
use App\ProcessType;
use App\Office;
use App\PrDescription;
use App\Status;
use App\AccountingProcess;
use App\BacProcess;
use App\EndorsingOffice;
use App\ReceivingOffice;
use App\BudgetProcess;
use App\GsoProcess;
use App\MmoProcess;
use App\MtoProcess;
use App\Endorsement;
use App\User;
use App\Event;
use input;
use DNS1D;
use Carbon\Carbon;
use App\AttachmentList;
use App\Attachment;
use App\ActionTaken;
use Yajra\Datatables\Datatables;
use App\EventUpdate;

class EndorsementController extends Controller
{
    /*
    | Shows only when Office ID is matched with the user's Office ID 
    */
    public function index(){
        $transactions = Endorsement::where('endorsing_offices_id', '=', auth()->user()->offices_id)->get();
        $endorsements = Endorsement::with('endorsing_offices', 'receiving_offices', 'transactions')->get();
        $actions = ActionTaken::all();
        if ($transactions != null) {
            return view('endorsement.index', compact('transactions', 'endorsements', 'actions'));
        }else{
            flash('Middleware Failure! Please Contact Administrator.')->error();
            return back()->withInput();
        }
    }

    /*
    | Page Redirection
    */
    Public function create($id){
        $endorsements = Endorsement::with('transactions', 'endorsing_offices', 'receiving_offices')->findorFail($id);
        $endorsing_offices = Office::all();
        $receiving_offices = Office::all();
        $statuses = Status::all();
        $prdescriptions = PrDescription::all();
        $user_offices = auth()->user()->offices->id;
        $attachmentLists = AttachmentList::all();
        $actions = ActionTaken::all();
        $users = User::all();
    	return view('endorsement.create',compact('endorsing_offices', 'receiving_offices', 'endorsements', 'prdescriptions', 'user_offices', 'statuses', 'attachmentLists', 'actions', 'users'));
    }

    /*
    | Storing to Endorsements
    */

    Public function store(Request $request, $id){
        /*
        | If Whole process is complete.. 
        */
        $statuses_id = $request->Input('statuses_id');    
        switch (auth()->user()->offices_id) {
            case auth()->user()->offices_id == 20 && $statuses_id == 4:
                $endorsements = Endorsement::findOrFail($id);
                $endorsements->date_endorsed = $request->Input('date_endorsed'); 
                $endorsements->date_received = $request->Input('date_endorsed'); 
                $endorsements->statuses_id = $statuses_id;
                $endorsements->action_takens_id = 1;
                $endorsements->users_id = auth()->user()->id;
                $endorsements->save();
                
                $transactions_id = $endorsements->transactions_id;
                $transactions = Transaction::findOrFail($transactions_id);
                $transactions->statuses_id = 4;
                $transactions->save();

                // Attachments
                $attachments = $request->input('attachments');
                $reference_id = $request->input('attachment_ref_id');

                // If attachment is not empty
                if (!Empty($attachments)) {
                    
                    foreach ($attachments as $data) {
                        $attachment = new Attachment;
                        $attachment->transactions_id = $endorsements->transactions_id;
                        $attachment->endorsements_id = $endorsements->id;
                        $attachment->attachment_lists_id = $data;
                        $attachment->reference_id;
                        $attachment->save();
                        // no reference ID yet ....
                    }
                }

                $event = new Event;
                $event->transactions_id = $endorsements->transactions_id;
                $event->endorsements_id = $endorsements->id;
                $event->users_id = auth()->user()->id;
                $event->report = $endorsements->transactions->process_types->name.' '.$endorsements->transactions->reference_id.' '.'has been processed successfuly.';
                $event->save();

                $report = $request->input('report');
                if(!Empty($report)){
                    $event = Event::where('endorsements_id', '=', $id)->first();
                    $events = new EventUpdate;
                    $events->events_id = $event->id;
                    $events->users_id = auth()->user()->id;
                    $events->datetime = $request->Input('date_endorsed');
                    $events->report = $report;
                    $events->save();
                }

                flash('Transaction is now complete.')->success();
                return redirect('/endorsement')->withInput();
            break;

            case auth()->user()->offices_id == 18 && $statuses_id == 4:
                $endorsements = Endorsement::findOrFail($id);
                $endorsements->date_endorsed = $request->Input('date_endorsed'); 
                $endorsements->date_received = $request->Input('date_endorsed'); 
                $endorsements->statuses_id = $statuses_id;
                $endorsements->action_takens_id = 1;
                $endorsements->users_id = auth()->user()->id;
                $endorsements->save();
                
                $transactions_id = $endorsements->transactions_id;
                $transactions = Transaction::findOrFail($transactions_id);
                $transactions->statuses_id = 4; 
                $transactions->save();

                // Attachments
                $attachments = $request->input('attachments');
                $reference_id = $request->input('attachment_ref_id');

                // If attachment is not empty
                if (!Empty($attachments)) {
                    
                    foreach ($attachments as $data) {
                        $attachment = new Attachment;
                        $attachment->transactions_id = $endorsements->transactions_id;
                        $attachment->endorsements_id = $endorsements->id;
                        $attachment->attachment_lists_id = $data;
                        $attachment->reference_id;
                        $attachment->save();
                        // no reference ID yet ....
                    }
                }

                $event = new Event;
                $event->transactions_id = $endorsements->transactions_id;
                $event->endorsements_id = $endorsements->id;
                $event->users_id = auth()->user()->id;
                $event->report = $endorsements->transactions->process_types->name.' '.$endorsements->transactions->reference_id.' '.'has been processed successfuly.';
                $event->save();

                $report = $request->input('report');
                if(!Empty($report)){
                    $event = Event::where('endorsements_id', '=', $id)->first();
                    $events = new EventUpdate;
                    $events->events_id = $event->id;
                    $events->users_id = auth()->user()->id;
                    $events->datetime = $request->Input('date_endorsed');
                    $events->report = $report;
                    $events->save();
                }

                flash('Transaction is now complete.')->success();
                return redirect('/endorsement')->withInput();
            break;


            case auth()->user()->offices_id == 19 && $statuses_id == 4:
                $endorsements = Endorsement::findOrFail($id);
                $endorsements->date_endorsed = $request->Input('date_endorsed'); 
                $endorsements->date_received = $request->Input('date_endorsed'); 
                $endorsements->statuses_id = $statuses_id;
                $endorsements->action_takens_id = 1;
                $endorsements->users_id = auth()->user()->id;
                $endorsements->save();
                
                $transactions_id = $endorsements->transactions_id;
                $transactions = Transaction::findOrFail($transactions_id);
                $transactions->statuses_id = 4;
                $transactions->save();

                // Attachments
                $attachments = $request->input('attachments');
                $reference_id = $request->input('attachment_ref_id');

                // If attachment is not empty
                if (!Empty($attachments)) {
                    
                    foreach ($attachments as $data) {
                        $attachment = new Attachment;
                        $attachment->transactions_id = $endorsements->transactions_id;
                        $attachment->endorsements_id = $endorsements->id;
                        $attachment->attachment_lists_id = $data;
                        $attachment->reference_id;
                        $attachment->save();
                        // no reference ID yet ....
                    }
                }

                $event = new Event;
                $event->transactions_id = $endorsements->transactions_id;
                $event->endorsements_id = $endorsements->id;
                $event->users_id = auth()->user()->id;
                $event->report = $endorsements->transactions->process_types->name.' '.$endorsements->transactions->reference_id.' '.'has been processed successfuly.';
                $event->save();

                $report = $request->input('report');
                if(!Empty($report)){
                    $event = Event::where('endorsements_id', '=', $id)->first();
                    $events = new EventUpdate;
                    $events->events_id = $event->id;
                    $events->users_id = auth()->user()->id;
                    $events->datetime = $request->Input('date_endorsed');
                    $events->report = $report;
                    $events->save();
                }

                flash('Transaction is now complete.')->success();
                return redirect('/endorsement')->withInput();
            break;

            case auth()->user()->offices_id == 6 && $statuses_id == 4:
                $endorsements = Endorsement::findOrFail($id);
                $endorsements->date_endorsed = $request->Input('date_endorsed'); 
                $endorsements->date_received = $request->Input('date_endorsed'); 
                $endorsements->statuses_id = $statuses_id;
                $endorsements->action_takens_id = 1;
                $endorsements->users_id = auth()->user()->id;
                $endorsements->save();
                
                $transactions_id = $endorsements->transactions_id;
                $transactions = Transaction::findOrFail($transactions_id);
                $transactions->statuses_id = 4;
                $transactions->save();

                // Attachments
                $attachments = $request->input('attachments');
                $reference_id = $request->input('attachment_ref_id');

                // If attachment is not empty
                if (!Empty($attachments)) {
                    
                    foreach ($attachments as $data) {
                        $attachment = new Attachment;
                        $attachment->transactions_id = $endorsements->transactions_id;
                        $attachment->endorsements_id = $endorsements->id;
                        $attachment->attachment_lists_id = $data;
                        $attachment->reference_id;
                        $attachment->save();
                        // no reference ID yet ....
                    }
                }

                $event = new Event;
                $event->transactions_id = $endorsements->transactions_id;
                $event->endorsements_id = $endorsements->id;
                $event->users_id = auth()->user()->id;
                $event->report = $endorsements->transactions->process_types->name.' '.$endorsements->transactions->reference_id.' '.'has been processed successfuly.';
                $event->save();

                $report = $request->input('report');
                if(!Empty($report)){
                    $event = Event::where('endorsements_id', '=', $id)->first();
                    $events = new EventUpdate;
                    $events->events_id = $event->id;
                    $events->users_id = auth()->user()->id;
                    $events->datetime = $request->Input('date_endorsed');
                    $events->report = $report;
                    $events->save();
                }

                flash('Transaction is now complete.')->success();
                return redirect('/endorsement')->withInput();
            break;

            case auth()->user()->offices_id == 5 && $statuses_id == 4:
                $endorsements = Endorsement::findOrFail($id);
                $endorsements->date_endorsed = $request->Input('date_endorsed'); 
                $endorsements->date_received = $request->Input('date_endorsed'); 
                $endorsements->statuses_id = $statuses_id;
                $endorsements->action_takens_id = 1;
                $endorsements->users_id = auth()->user()->id;
                $endorsements->save();
                
                $transactions_id = $endorsements->transactions_id;
                $transactions = Transaction::findOrFail($transactions_id);
                $transactions->statuses_id = 4;
                $transactions->save();

                // Attachments
                $attachments = $request->input('attachments');
                $reference_id = $request->input('attachment_ref_id');

                // If attachment is not empty
                if (!Empty($attachments)) {
                    
                    foreach ($attachments as $data) {
                        $attachment = new Attachment;
                        $attachment->transactions_id = $endorsements->transactions_id;
                        $attachment->endorsements_id = $endorsements->id;
                        $attachment->attachment_lists_id = $data;
                        $attachment->reference_id;
                        $attachment->save();
                        // no reference ID yet ....
                    }
                }

                $event = new Event;
                $event->transactions_id = $endorsements->transactions_id;
                $event->endorsements_id = $endorsements->id;
                $event->users_id = auth()->user()->id;
                $event->report = $endorsements->transactions->process_types->name.' '.$endorsements->transactions->reference_id.' '.'has been processed successfuly.';
                $event->save();

                $report = $request->input('report');
                if(!Empty($report)){
                    $event = Event::where('endorsements_id', '=', $id)->first();
                    $events = new EventUpdate;
                    $events->events_id = $event->id;
                    $events->users_id = auth()->user()->id;
                    $events->datetime = $request->Input('date_endorsed');
                    $events->report = $report;
                    $events->save();
                }

                flash('Transaction is now complete.')->success();
                return redirect('/endorsement')->withInput();
            break;

            case auth()->user()->offices_id == 9 && $statuses_id == 4:
                $endorsements = Endorsement::findOrFail($id);
                $endorsements->date_endorsed = $request->Input('date_endorsed'); 
                $endorsements->date_received = $request->Input('date_endorsed'); 
                $endorsements->statuses_id = $statuses_id;
                $endorsements->action_takens_id = 1;
                $endorsements->users_id = auth()->user()->id;
                $endorsements->save();
                
                $transactions_id = $endorsements->transactions_id;
                $transactions = Transaction::findOrFail($transactions_id);
                $transactions->statuses_id = 4;
                $transactions->save();

                // Attachments
                $attachments = $request->input('attachments');
                $reference_id = $request->input('attachment_ref_id');

                // If attachment is not empty
                if (!Empty($attachments)) {
                    
                    foreach ($attachments as $data) {
                        $attachment = new Attachment;
                        $attachment->transactions_id = $endorsements->transactions_id;
                        $attachment->endorsements_id = $endorsements->id;
                        $attachment->attachment_lists_id = $data;
                        $attachment->reference_id;
                        $attachment->save();
                        // no reference ID yet ....
                    }
                }

                $event = new Event;
                $event->transactions_id = $endorsements->transactions_id;
                $event->endorsements_id = $endorsements->id;
                $event->users_id = auth()->user()->id;
                $event->report = $endorsements->transactions->process_types->name.' '.$endorsements->transactions->reference_id.' '.'has been processed successfuly.';
                $event->save();

                $report = $request->input('report');
                if(!Empty($report)){
                    $event = Event::where('endorsements_id', '=', $id)->first();
                    $events = new EventUpdate;
                    $events->events_id = $event->id;
                    $events->users_id = auth()->user()->id;
                    $events->datetime = $request->Input('date_endorsed');
                    $events->report = $report;
                    $events->save();
                }

                flash('Transaction is now complete.')->success();
                return redirect('/endorsement')->withInput();
            break;

            // If office is Proc and Status is in progress 
            case auth()->user()->offices_id == 6 && $statuses_id == 2:
                $date = $request->input('date_endorsed');
                $endorsements = Endorsement::findorFail($id);
                $endorsements->receiving_offices_id = $request->Input('receiving_offices_id');
                $endorsements->date_endorsed = $date;
                $endorsements->statuses_id = $statuses_id;
                $endorsements->action_takens_id = 1;
                $endorsements->users_id = auth()->user()->id;
                $endorsements->receivingstaff_id = $request->Input('receivingstaff_id');
                $endorsements->save();
                
                $transactions_id = $endorsements->transactions_id;
                $transactions = Transaction::findOrFail($transactions_id);
                $transactions->statuses_id = $statuses_id;
                $transactions->canvassers_id = $request->Input('canvasser');
                $transactions->save();

                /*
                | Events for endorsements
                */

                switch ($statuses_id) {
                    case $statuses_id == 2:
                        $staff = Endorsement::where('id', '=', $endorsements->id)
                        ->where('transactions_id', '=', $transactions_id)
                        ->latest()->first();
                        // dd($staff);
                        $event = new Event;
                        $event->transactions_id = $transactions_id;
                        $event->endorsements_id = $endorsements->id;
                        $event->users_id = auth()->user()->id;
                        $event->report = auth()->user()->initials.'('.auth()->user()->offices->abbr.')'.' '.'endorsed to '.$staff->receivingstaffs->initials.'('.$staff->receivingstaffs->offices->abbr.')'; // Need to include the receiving offices name
                        $event->save();

                        $report = $request->input('report');
                        if(!Empty($report)){
                            $event = Event::where('endorsements_id', '=', $id)->first();
                            $events = new EventUpdate;
                            $events->events_id = $event->id;
                            $events->users_id = auth()->user()->id;
                            $events->datetime = $request->Input('date_endorsed');
                            $events->report = $report;
                            $events->save();
                        }

                        // Attachments
                        $attachments = $request->input('attachments');
                        $reference_id = $request->input('attachment_ref_id');

                        // If attachment is not empty
                        if (!Empty($attachments)) {
                            
                            foreach ($attachments as $data) {
                                $attachment = new Attachment;
                                $attachment->transactions_id = $endorsements->transactions_id;
                                $attachment->endorsements_id = $endorsements->id;
                                $attachment->attachment_lists_id = $data;
                                $attachment->reference_id;
                                $attachment->save();
                                // no reference ID yet ....
                            }
                        }

                        break;

                    case $statuses_id == 3:
                        $event = new Event;
                        $event->transactions_id = $transactions_id;
                        $event->endorsements_id = $endorsements->id;
                        $event->users_id = auth()->user()->id;
                        $event->report = $endorsements->transactions->process_types->name.' '.$endorsements->transactions->reference_id.' '.'document has been cancelled.';
                        $event->save();

                        $report = $request->input('report');
                        if(!Empty($report)){
                            $event = Event::where('endorsements_id', '=', $id)->first();
                            $events = new EventUpdate;
                            $events->events_id = $event->id;
                            $events->users_id = auth()->user()->id;
                            $events->datetime = $request->Input('date_endorsed');
                            $events->report = $report;
                            $events->save();
                        }
                        break;
                    default:
                        dd("Something went wrong");
                }

                flash('Succesfully endorsed.')->success();
                return redirect('home')->withInput();
            break;
            
            default:
                $date = $request->input('date_endorsed');
                $endorsements = Endorsement::findOrFail($id);
                $endorsements->receiving_offices_id = $request->Input('receiving_offices_id');
                $endorsements->date_endorsed = $date;
                $endorsements->statuses_id = $statuses_id;
                $endorsements->action_takens_id = 1;
                $endorsements->users_id = auth()->user()->id;
                $endorsements->receivingstaff_id = $request->Input('receivingstaff_id');
                $endorsements->save();
                
                $transactions_id = $endorsements->transactions_id;
                $transactions = Transaction::findOrFail($transactions_id);
                $transactions->statuses_id = $statuses_id;
                $transactions->save();

                /*
                | Events for endorsements
                */

                switch ($statuses_id) {
                    case $statuses_id == 2:
                        $staff = Endorsement::where('id', '=', $endorsements->id)
                            ->where('transactions_id', '=', $transactions_id)
                            ->latest()->first();
                        // dd($staff);
                        $event = new Event;
                        $event->transactions_id = $transactions_id;
                        $event->endorsements_id = $endorsements->id;
                        $event->users_id = auth()->user()->id;
                        $event->report = auth()->user()->initials.'('.auth()->user()->offices->abbr.')'.' '.'endorsed to '.$staff->receivingstaffs->initials.'('.$staff->receivingstaffs->offices->abbr.')'; // Need to include the receiving offices name
                        $event->save();

                        $report = $request->input('report');
                        if(!Empty($report)){
                            $event = Event::where('endorsements_id', '=', $id)->first();
                            $events = new EventUpdate;
                            $events->events_id = $event->id;
                            $events->users_id = auth()->user()->id;
                            $events->datetime = $request->Input('date_endorsed');
                            $events->report = $report;
                            $events->save();
                        }

                        // Attachments
                        $attachments = $request->input('attachments');
                        $reference_id = $request->input('attachment_ref_id');

                        // If attachment is not empty
                        if (!Empty($attachments)) {
                            
                            foreach ($attachments as $data) {
                                $attachment = new Attachment;
                                $attachment->transactions_id = $endorsements->transactions_id;
                                $attachment->endorsements_id = $endorsements->id;
                                $attachment->attachment_lists_id = $data;
                                $attachment->reference_id;
                                $attachment->save();
                                // no reference ID yet ....
                            }
                        }

                        break;

                    case $statuses_id == 3:
                        $event = new Event;
                        $event->transactions_id = $transactions_id;
                        $event->endorsements_id = $endorsements->id;
                        $event->users_id = auth()->user()->id;
                        $event->report = $endorsements->transactions->process_types->name.' '.$endorsements->transactions->reference_id.' '.'document has been cancelled.';
                        $event->save();

                        $report = $request->input('report');
                        if(!Empty($report)){
                            $event = Event::where('endorsements_id', '=', $id)->first();
                            $events = new EventUpdate;
                            $events->events_id = $event->id;
                            $events->users_id = auth()->user()->id;
                            $events->datetime = $request->Input('date_endorsed');
                            $events->report = $report;
                            $events->save();
                        }
                        break;
                    default:
                        dd("Something went wrong");
                }

                flash('Succesfully endorsed.')->success();
                return redirect('home')->withInput();
            break;
        }
    }

    /*
    | Accepting Documents
    */
    public function accept($id){
        /*
        | Updating the received date & changing the status to complete
        */
        $endorsements = Endorsement::findorFail($id);
        $time = Carbon::now()->format('Y-m-d');
        $endorsements->date_received = $time;
        $endorsements->statuses_id = 4; //complete
        $endorsements->action_takens_id = $endorsements->action_takens_id; //by default
        // $endorsements->users_id = auth()->user()->id;
        $endorsements->save();

        $events = new Event;
        $events->transactions_id = $endorsements->transactions_id;
        $events->endorsements_id = $endorsements->id;
        $events->users_id = auth()->user()->id;
        $events->report = auth()->user()->initials.'('.auth()->user()->offices->abbr.')'.' accepts '.$endorsements->transactions->process_types->name.' - '.$endorsements->transactions->reference_id;
        $events->save();

        /*
        | Updating overall process status to "In Progress"
        */

        $transactions_id = $endorsements->transactions_id;
        $query = Transaction::findOrFail($transactions_id);
        $query->statuses_id = 2;
        $query->save();


        /*
        | Storing new endorsement
        */

        $data = new Endorsement;
        $data->transactions_id = $transactions_id;
        $data->endorsing_offices_id = auth()->user()->offices_id;
        $data->statuses_id = 1; // pending
        $data->action_takens_id = 1; // default
        $data->users_id = auth()->user()->id;
        $data->save();

        flash('Endorsement has been accepted')->success();
        return redirect('/endorsement')->withInput();
    }

    /*
    | User Endorsement History
    */
    public function history(Request $request){
        if($request->ajax()){  
            $data = Endorsement::with('endorsing_offices', 'transactions', 'receiving_offices')
                ->where('endorsing_offices_id', '=', auth()->user()->offices_id)
                ->get();
            return Datatables::of($data)
                ->addColumn('action', function($data){
                    $button = '<a href="/find/records/'.$data->transactions_id.'" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-magnify"></i></a>';
                    $button1 = ' <a href="/endorsement/edit/records/'.$data->id.'" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-pencil"></i></a>';
                    $button2 = ' <a href="/endorsement/delete/records/'.$data->id.'" class="btn btn-xs btn-outline-danger"><i class="mdi mdi-close"></i></a>';
                    return $button.$button1.$button2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('endorsement.history');
    }

    public function edit($id){

        $endorsements = Endorsement::with('transactions', 'endorsing_offices', 'receiving_offices', 'users')->findOrFail($id)->first();
        // dd($endorsements);
        return view('endorsement.edit', compact('endorsements'));
    }

}
