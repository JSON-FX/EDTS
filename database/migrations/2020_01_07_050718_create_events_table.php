<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('transactions_id')->nullable()->unsigned()->index();
            $table->integer('endorsements_id')->nullable()->unsigned()->index();
            $table->integer('users_id')->nullable()->unsigned()->index();
            $table->string('report')->nullable();
            $table->timestamps();

            $table->foreign('users_id')
              ->references('id')
              ->on('users');
              

            $table->foreign('transactions_id')
              ->references('id')
              ->on('transactions');
              

            $table->foreign('endorsements_id')
              ->references('id')
              ->on('endorsements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
