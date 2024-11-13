<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInitialsToUsersTable extends Migration
{
    /**
     * Adding new column to the user table
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('initials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('initials');
        });
    }
}
