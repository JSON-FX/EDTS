<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('Statuses')->insert([
            [
                'name' => 'None'
            ],
            [
                'name' => 'In Progress'
            ],
            [
                'name' => 'Cancelled'
            ],
            [
                'name' => 'Complete'
            ]
        ]);
        //
    }
}
