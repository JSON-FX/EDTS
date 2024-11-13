<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionTakenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('action_takens')->insert([
            [
                'name' => 'None'
            ],
            [
                'name' => 'For Obligation Request'
            ],
            [
                'name' => 'For Approval'
            ],
            [
                'name' => 'For BAC Meeting (Mode of Procurement)'
            ],
            [
                'name' => 'For Canvassing'
            ],
            [
                'name' => 'For Award'
            ],
            [
                'name' => "For Mayor's Approval (NOA of Summary of Price Quotation)"
            ],
            [
                'name' => 'To Complete P.R'
            ],
            [
                'name' => "For Mayor's Signature"
            ],
            [
                'name' => 'For Supplier Signature'
            ],
            [
                'name' => 'Waiting For Delivery'
            ],
            [
                'name' => 'For Attachment of Supporting Documents'
            ],
            [
                'name' => 'To Complete P.O'
            ],
            [
                'name' => 'For Journal Entry Voucher'
            ],
            [
                'name' => 'For Preparation of Check with Signature'
            ],
            [
                'name' => "Check for Mayor's Signature"
            ],
            [
                'name' => 'For Disbursement and Completion of Voucher'
            ]
        ]);
    }
}
