<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OfficeTableSeeder::class);
        $this->call(PrDescriptionTableSeeder::class);
        $this->call(ProcessTypeTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(AttachmentSeeder::class);
        $this->call(ActionTakenTableSeeder::class);
        $this->call(CanvasserTableSeeder::class);
        $this->call(EndorsingOfficeTableSeeder::class);
        $this->call(ReceivingOfficeTableSeeder::class);
    }
}
