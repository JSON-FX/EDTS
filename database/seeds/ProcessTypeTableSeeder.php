<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('process_types')->insert([
            [
                'name' => 'Purchase Request'
            ],
            [
                'name' => 'Purchase Order'
            ],
            [
                'name' => 'Voucher'
            ]
        ]);
        //
    }
}
