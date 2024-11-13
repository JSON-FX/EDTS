<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReceivingstaffToEndorsementsTable extends Migration
{
    /**
     * Add receivingstaff to endorsement table
     *
     * @return void
     */
    public function up()
    {
        Schema::table('endorsements', function($table) {
            $table->integer('receivingstaff_id')->nullable()->unsigned()->index();

            $table->foreign('receivingstaff_id')
              ->references('id')
              ->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endorsements', function($table) {
            $table->dropColumn('receivingstaff');
        });
    }
}
