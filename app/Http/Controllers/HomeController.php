<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Office;
use App\ProcessType;
use App\Status;
use App\Transaction;
use App\Endorsement;
use Yajra\Datatables\Datatables;
use App\Event;
use App\EventUpdate;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $offices = Office::all();
        $process_types = ProcessType::all();
        $statuses = Status::all();
        //Summary View
            // PR
            $completed_PR = Transaction::where('statuses_id', 4)->where('process_types_id', 1)->count();
            $pending_PR = Transaction::where('statuses_id', 1)->where('process_types_id', 1)->count();
            $inProgress_PR = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->count();
            $cancelled_PR = Transaction::where('statuses_id', 3)->where('process_types_id', 1)->count();
            // PO
            $completed_PO = Transaction::where('statuses_id', 4)->where('process_types_id', 2)->count();
            $pending_PO = Transaction::where('statuses_id', 1)->where('process_types_id', 2)->count();
            $inProgress_PO = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->count();
            $cancelled_PO = Transaction::where('statuses_id', 3)->where('process_types_id', 2)->count();
            // Voucher
            $completed_Voucher = Transaction::where('statuses_id', 4)->where('process_types_id', 3)->count();
            $pending_Voucher = Transaction::where('statuses_id', 1)->where('process_types_id', 3)->count();
            $inProgress_Voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->count();
            $cancelled_Voucher = Transaction::where('statuses_id', 3)->where('process_types_id', 3)->count();
            // Total Records
            $transaction_total = Transaction::all()->count();
            // Offices
            //MBO
            $mbo_pr = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 18)
            ->count();
            $mbo_pr_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 18)
            ->get();
            $mbo_po = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 18)
            ->count();
            $mbo_po_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 18)
            ->get();
            $mbo_voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 18)
            ->count();
            $mbo_voucher_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 18)
            ->get();
            //MMO
            $mmo_pr = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 24)
            ->count();
            $mmo_pr_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 24)
            ->get();
            $mmo_po = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 24)
            ->count();
            $mmo_po_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 24)
            ->get();
            $mmo_voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 24)
            ->count();
            $mmo_voucher_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 24)
                ->get();
            //BAC
            $bac_pr = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 5)
            ->count();
            $bac_pr_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 5)
            ->get();
            $bac_po = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 5)
            ->count();
            $bac_po_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 5)
            ->get();
            $bac_voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 5)
            ->count();
            $bac_voucher_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 5)
            ->get();
            //Procurement
            $proc_pr = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 6)
            ->count();
            $proc_pr_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 6)
            ->get();
            $proc_po = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 6)
            ->count();
            // dd($proc_po);
            $proc_po_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 6)
            ->get();
            $proc_voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 6)
            ->count();
            $proc_voucher_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 6)
            ->get();
            //SUPPLIER
            $supplier_pr = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 35)
            ->count();
            $supplier_pr_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.canvassers_id',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 35)
            ->get();
            $supplier_po = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 35)
            ->count();
            $supplier_po_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.canvassers_id',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 35)
            ->get();
            $supplier_voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 36)
            ->count();
            $supplier_voucher_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.canvassers_id',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 36)
            ->get();
            //PSMO
            $psmo_pr = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 9)
            ->count();
            $psmo_pr_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 9)
            ->get();
            $psmo_po = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 9)
            ->count();
            $psmo_po_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 9)
            ->get();
            $psmo_voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 9)
            ->count();
            $psmo_voucher_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 9)
            ->get();
            //MACCO
            $macco_pr = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 19)
            ->count();
            $macco_pr_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 19)
            ->get();
            $macco_po = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 19)
            ->count();
            $macco_po_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 19)
            ->get();
            $macco_voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 19)
            ->count();
            $macco_voucher_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 19)
            ->get();
            //MTO
            $mto_pr = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 20)
            ->count();
            $mto_pr_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 1)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 20)
            ->get();
            $mto_po = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 20)
            ->count();
            $mto_po_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 2)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 20)
            ->get();
            $mto_voucher = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 20)
            ->count();
            $mto_voucher_res = DB::table('endorsements')
                ->join('transactions', 'endorsements.transactions_id', '=', 'transactions.id')
                ->select(
                    'endorsements.id',
                    'endorsements.transactions_id',
                    'endorsements.endorsing_offices_id',
                    'endorsements.receiving_offices_id',
                    'endorsements.date_endorsed',
                    'endorsements.date_received',
                    'endorsements.statuses_id',
                    'endorsements.action_takens_id',
                    'endorsements.updated_at',
                    'transactions.date_of_entry',
                    'transactions.reference_id',
                    'transactions.sub_reference_id',
                    'transactions.description',
                    'transactions.process_types_id',
                    'transactions.offices_id',
                    'transactions.pr_descriptions_id',
                    'transactions.amount',
                    'transactions.pr_actual_amount',
                    'transactions.client',
                    'transactions.address',
                    'transactions.endorsement_date',
                    'transactions.created_at'

                )
                ->where('transactions.process_types_id', '=', 3)
                ->where('transactions.statuses_id', '=', 2 )
                ->whereIn('endorsements.statuses_id', [1, 2])
                ->where('endorsements.endorsing_offices_id', '=', 20)
            ->get();
        //End Summary view
        $events = Event::with('users', 'endorsements')->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            $data = Transaction::with('process_types', 'statuses', 'offices', 'users')->get();

            // custom filter
           $filter_office = $request->filter_office;
           $filter_classification = $request->filter_classification;
           $filter_status = $request->filter_status;

           if(!empty($filter_office) && $filter_office != 'Office' && !empty($filter_classification) && $filter_classification != 'Classification' && !empty($filter_status) && $filter_status != 'Status'){
                // Office, Classification, Status is not empty
                $data = Transaction::with('offices', 'statuses', 'process_types')
                    ->where('offices_id','=', $request->filter_office)
                    ->where('statuses_id','=', $request->filter_status)
                    ->where('process_types_id','=', $request->filter_classification)
                    ->get();
                // dd($transactions);
           }elseif (!empty($filter_office) && $filter_office != 'Office' && !empty($filter_classification) && $filter_classification != 'Classification' && !empty($filter_status) && $filter_status == 'Status') {
                // Office, Classification is not empty while Status empty
                // dd('Status is Empty');
                $data = Transaction::with('offices', 'statuses', 'process_types')
                ->where('offices_id','=', $request->filter_office)
                ->where('process_types_id','=', $request->filter_classification)
                ->get();
           }elseif (!empty($filter_office) && $filter_office != 'Office' && !empty($filter_classification) && $filter_classification == 'Classification' && !empty($filter_status) && $filter_status == 'Status') {
                // Classification, Satus is Empty
                $data = Transaction::with('offices', 'statuses', 'process_types')
                ->where('offices_id','=', $request->filter_office)
                ->get();
                // dd('Classification, Satus is Empty');
           }elseif (!empty($filter_office) && $filter_office == 'Office' && !empty($filter_classification) && $filter_classification == 'Classification' && !empty($filter_status) && $filter_status != 'Status') {
                // Office, Classification is empty
                $data = Transaction::with('offices', 'statuses', 'process_types')
                ->where('statuses_id','=', $request->filter_status)
                ->get();
                // dd('Office, Classification is empty');
           }elseif (!empty($filter_office) && $filter_office == 'Office' && !empty($filter_classification) && $filter_classification != 'Classification' && !empty($filter_status) && $filter_status == 'Status') {
                // Office, Status is empty
                $data = Transaction::with('offices', 'statuses', 'process_types')
                ->where('process_types_id','=', $request->filter_classification)
                ->get();
                // dd('Office, Status is empty');
           }elseif (!empty($filter_office) && $filter_office != 'Office' && !empty($filter_classification) && $filter_classification == 'Classification' && !empty($filter_status) && $filter_status == 'Status') {
                // Classification, Status is empty
                $data = Transaction::with('offices', 'statuses', 'process_types')
                ->where('offices_id','=', $request->filter_office)
                ->get();
                // dd('Classification, Status is empty');
           }elseif (!empty($filter_office) && $filter_office == 'Office' && !empty($filter_classification) && $filter_classification != 'Classification' && !empty($filter_status) && $filter_status != 'Status') {
                // Classification, Status is not empty
                $data = Transaction::with('offices', 'statuses', 'process_types')
                ->where('statuses_id','=', $request->filter_status)
                ->where('process_types_id','=', $request->filter_classification)
                ->get();
                // dd('Classification, Status is not empty');
           }elseif (!empty($filter_office) && $filter_office != 'Office' && !empty($filter_classification) && $filter_classification == 'Classification' && !empty($filter_status) && $filter_status != 'Status') {
                // Office, Status is not empty
                $data = Transaction::with('offices', 'statuses', 'process_types')
                ->where('offices_id','=', $request->filter_office)
                ->where('statuses_id','=', $request->filter_status)
                ->get();
                // dd('Office, Status is not empty');
           }else{

           }

            return Datatables::of($data)
                ->addColumn('action', function($data){
                    $button = '<a href="/find/records/'.$data->id.'" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-magnify"><i></a>';
                    return $button;
                })
                ->addColumn('status', function($data){
                    // $button = 'status';
                    // return $button;
                    switch ($data->statuses->name) {
                            case $data->statuses->name == "None":
                                $column = '<span class="badge badge-inverse-primary">'.'<span class="status-indicator rounded-indicator bg-primary"></span>Not Endorsed</span>';
                                return $column;
                                break;
                            case $data->statuses->name == "Complete":
                                $column = '<span class="badge badge-inverse-success">'.'<span class="status-indicator rounded-indicator bg-success">'.'</span>'.$data->statuses->name.'</span>';
                                return $column;
                                break;
                            case $data->statuses->name == "In Progress":
                                $column = '<span class="badge badge-inverse-warning">'.'<span class="status-indicator rounded-indicator bg-primary">'.'</span>'.$data->statuses->name.'</span>';
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
                            $column = $data->offices->abbr;
                            return $column;
                            break;

                         // Purchase Order
                        case $data->process_types_id == 2:
                            $column = $data->client;
                            return $column;
                            break;

                        // Voucher
                        case $data->process_types_id == 3:
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
        return view('home', compact(
            'events',
            'offices',
            'statuses',
            'process_types',
            'completed_PR',
            'pending_PR',
            'inProgress_PR',
            'cancelled_PR',
            'completed_PO',
            'pending_PO',
            'inProgress_PO',
            'cancelled_PO',
            'completed_Voucher',
            'pending_Voucher',
            'inProgress_Voucher',
            'cancelled_Voucher',
            'transaction_total',
            'mbo_pr',
            'mbo_pr_res',
            'mbo_po',
            'mbo_po_res',
            'mbo_voucher',
            'mbo_voucher_res',
            'mmo_pr',
            'mmo_pr_res',
            'mmo_po',
            'mmo_po_res',
            'mmo_voucher',
            'mmo_voucher_res',
            'bac_pr',
            'bac_pr_res',
            'bac_po',
            'bac_po_res',
            'bac_voucher',
            'bac_voucher_res',
            'proc_pr',
            'proc_pr_res',
            'proc_po',
            'proc_po_res',
            'proc_voucher',
            'proc_voucher_res',
            'supplier_pr',
            'supplier_pr_res',
            'supplier_po',
            'supplier_po_res',
            'supplier_voucher',
            'supplier_voucher_res',
            'psmo_pr',
            'psmo_pr_res',
            'psmo_po',
            'psmo_po_res',
            'psmo_voucher',
            'psmo_voucher_res',
            'macco_pr',
            'macco_pr_res',
            'macco_po',
            'macco_po_res',
            'macco_voucher',
            'macco_voucher_res',
            'mto_pr',
            'mto_pr_res',
            'mto_po',
            'mto_po_res',
            'mto_voucher',
            'mto_voucher_res'
        ));
    }

    public function summary(Request $request){
        $offices = Office::all();
        $process_types = ProcessType::all();
        $statuses = Status::all();

        if ($request->ajax()) {
            $data = Endorsement::with('endorsing_offices', 'transactions')
            ->where('statuses_id', '=', 2)
            ->get();

            // custom filter
           $filter_office = $request->filter_office;
           $filter_classification = $request->filter_classification;
           $filter_status = $request->filter_status;

           if(!empty($filter_office) && $filter_office != 'Office' && !empty($filter_classification) && $filter_classification != 'Classification' && !empty($filter_status) && $filter_status != 'Status'){
                // Office, Classification, Status is not empty
                $data = Transaction::with('offices', 'statuses', 'process_types', 'transactions')
                    ->where('endorsing_offices_id','=', $request->filter_office)
                    ->where('statuses_id','=', $request->filter_status)
                    ->where('transactions.process_types_id','=', $request->filter_classification)
                    ->get();
                // dd($transactions);
           }else{

           }

            return Datatables::of($data)
                ->addColumn('classification', function($data){
                    $info = $data->transactions->process_types->name;
                    return $info;
                })
                ->addColumn('pr_descriptions', function($data){
                    $info = $data->transactions->pr_descriptions->name;
                    return $info;
                })
                ->addColumn('action', function($data){
                    $button = '<a href="/find/records/'.$data->transactions_id.'" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-magnify"><i></a>';
                    return $button;
                })
                ->rawColumns(['classification', 'pr_descriptions', 'action'])
                ->make(true);
        }
        $events = EventUpdate::with('events')->get();
        return view('report.summary', compact('events', 'offices', 'statuses', 'process_types'));
    }
}
