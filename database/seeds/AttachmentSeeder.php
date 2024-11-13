<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attachment_lists')->insert([
            [
              'name' => 'Voucher'
            ],
            [
        		'name' => 'General Payroll'
            ],
            [
        		'name' => 'Daily Time Record'
            ],
            [
        		'name' => 'Accomplishment'
            ],
            [
        		'name' => 'Overtime Order'
            ],
            [
        		'name' => 'Estimated Budget'
            ],
            [
        		'name' => 'Itinerary '
            ],
            [
        		'name' => 'Certificate of Appearance '
            ],
            [
        		'name' => 'Approve Travel Order'
            ],
            [
        		'name' => 'Bus Ticket'
            ],
            [
        		'name' => 'Payroll Jacket'
            ],
            [
        		'name' => 'Time Book'
            ],
            [
        		'name' => 'Approve Job Order'
            ],
            [
        		'name' => 'Program Design'
            ],
            [
              'name' => 'Activity Design'
            ],
            [
        		'name' => 'Accomplishment Report'
            ],
            [
        		'name' => 'Obligation Request Computation'
            ],
            [
        		'name' => 'Leave Form'
            ],
            [
        		'name' => 'Travel Order'
            ],
            [
        		'name' => 'Payroll Job Order'
            ],
            [
        		'name' => 'Payroll Time Book'
            ],
            [
        		'name' => 'Job Order Contract'
            ],
            [
        		'name' => 'Detail Order'
            ],
            [
        		'name' => 'Time Book General'
            ],  
            [
        		'name' => 'Purchase Request'
            ],
            [
        		'name' => 'Bid Form'
            ],
            [
        		'name' => 'Bill of Quantities'
            ],
            [
        		'name' => 'Production Delivery Schedule'
            ],
            [
        		'name' => 'Technical Specification'
            ],
            [
        		'name' => 'Abstract of Bid as Read and Calculated'
            ],
            [
        		'name' => 'Minutes of Bidding'
            ],
            [
        		'name' => 'BAC Resolution declaring Lowest Calculated & Responsive Bidder'
            ],
            [
        		'name' => 'Notice of Award'
            ],
            [
        		'name' => 'Contract of Agreement'
            ],
            [
        		'name' => 'Contract of Agreement Form'
            ],
            [
        		'name' => 'Notice to Proceed'
            ],
            [
        		'name' => 'Inspection and Acceptance Report'
            ],
            [
        		'name' => 'Requisition and Issue Slip'
            ],
            [
        		'name' => 'Property Acknowledgement Receipt'
            ],
            [
        		'name' => 'Obligation Request'
            ],
            [
        		'name' => 'Minutes 2nd Failure'
            ],
            [
        		'name' => 'Resolution Recommending for Alternative Method'
            ],
            [
        		'name' => 'Request for Quotation / Canvass'
            ],
            [
        		'name' => 'Business Permit'
            ],
            [
        		'name' => 'Philgeps'
            ],
            [
        		'name' => 'Omnibus'
            ],
            [
        		'name' => 'Income Tax Return'
            ],
            [
        		'name' => 'Program of Works'
            ],
            [
        		'name' => 'Description of Materials'
            ],
            [
        		'name' => 'Training / Program Design'
            ],
            [
        		'name' => 'Letter Request'
            ],
            [
        		'name' => 'BAC Approval'
            ],
            [
        		'name' => 'Request for Pre-inspection'
            ],
            [
        		'name' => 'Report of Waste Material'
            ],
            [
        		'name' => 'Certificate of End User'
            ],
            [
        		'name' => 'Canvass'
            ],
            [
        		'name' => 'Summary of Price Quotation'
            ],
            [
        		'name' => 'Purchase Order'
            ],
            [
        		'name' => 'IAR'
            ],
            [
        		'name' => 'RIS'
            ],
            [
        		'name' => 'Disbursement'
            ],
            [
              'name' => 'Project Procurement Management Plan'
            ],
            [
              'name' => 'Sales Invoice/O.R'
            ],
            [
              'name' => 'Cheque'
            ],
            [
              'name' => 'Journal Entry Voucher'
            ],
            [
              'name' => 'Memo Slip'
            ],
            [
              'name' => 'Mode or Procurement'
            ]
        ]);
    }
}
