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
use App\ActionTaken;
use App\Endorsement;
use App\Office;
use App\Status;

class SearchController extends Controller
{
    public function index(Request $request){
        // $transactions = Transaction::with('process_types')->get();
        // return view('search.index', compact('transactions'));
        // $transactions = Transaction::all();
        /*
            Server-side Processing
            Returns the query of Province model and adding new column for action
        */
        $offices = Office::all();
        $statuses = Status::all();
        if ($request->ajax()) {
            $data = Transaction::with('process_types', 'statuses');
            return Datatables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<a href="/find/records/'.$data->id.'" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-magnify"><i></a>';
                        return $button;
                    })
                    ->addColumn('status', function($data){
                        // $button = 'status';
                        // return $button;
                        switch ($data->statuses->name) {
                            case $data->statuses->name == "Pending":
                                $column = '<span class="badge badge-inverse-warning">'.'<span class="status-indicator rounded-indicator bg-warning">'.'</span>'.$data->statuses->name.'</span>';
                                return $column;
                                break;
                            case $data->statuses->name == "Complete":
                                $column = '<span class="badge badge-inverse-success">'.'<span class="status-indicator rounded-indicator bg-success">'.'</span>'.$data->statuses->name.'</span>';
                                return $column;
                                break;
                            case $data->statuses->name == "In Progress":
                                $column = '<span class="badge badge-inverse-warning">'.'<span class="status-indicator rounded-indicator bg-warning">'.'</span>'.$data->statuses->name.'</span>';
                                return $column;
                            break;
                            case $data->statuses->name == "Cancelled":
                                $column = '<span class="badge badge-inverse-danger">'.'<span class="status-indicator rounded-indicator bg-danger">'.'</span>'.$data->statuses->name.'</span>';
                                return $column;
                            break;
                            default:
                                $message = 'Please Contact Administrator';
                                return $message;
                            break;
                        }
                    })
                    ->addColumn('client', function($data){
                        switch ($data->process_types_id) {
                            // Purchase Request
                            case $data->process_types_id == 1:
                                $column = $data->offices->name;
                                return $column;
                                break;
                            // Financial Assistance
                            case $data->process_types_id == 2:
                                $column = $data->client;
                                return $column;
                                break;
                            // Internet Billing
                            case $data->process_types_id == 3:
                                $column = $data->client;
                                return $column;
                            break;
                            // Mobile Allowance
                            case $data->process_types_id == 4:
                                $column = $data->client;
                                return $column;
                            break;

                            // Monetization of Leave Credits
                            case $data->process_types_id == 5:
                                $column = $data->client;
                                return $column;
                            break;

                            // Payroll Overtime
                            case $data->process_types_id == 6:
                                $column = $data->client;
                                return $column;
                            break;

                            // Payroll Salary
                            case $data->process_types_id == 7:
                                $column = $data->client;
                                return $column;
                            break;

                            default:
                                $message = 'Please Contact Administrator';
                                return $message;
                            break;
                        }
                    })
                    ->rawColumns(['action', 'status', 'client'])
                    ->make(true);
        }
        return view('search.index', compact('offices', 'statuses'));
    }

    public function find($id){
        $transactions = Transaction::findOrFail($id);
        $events = Event::where('transactions_id', '=', $transactions->id)->orderBy('id', 'Desc')->get();
        $office_holder = Endorsement::with('users')
            ->where('transactions_id', '=', $transactions->id)
            ->orderBy('id', 'Desc')
            ->first();
        $event_id = Event::where('transactions_id', '=', $transactions->id)->first();
        $eventupdates = EventUpdate::all();
        $attachments = Attachment::where('transactions_id', '=', $transactions->id)->get();
        return view('search.result', compact('transactions', 'events', 'attachments', 'eventupdates', 'office_holder'));
    }
}
