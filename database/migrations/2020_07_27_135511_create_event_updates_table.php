<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_updates', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('events_id')->nullable()->unsigned()->index();
            $table->integer('users_id')->nullable()->unsigned()->index();
            $table->string('datetime');
            $table->text('report');
            $table->timestamps();

            $table->foreign('events_id')
              ->references('id')
              ->on('events');

            $table->foreign('users_id')
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
        Schema::dropIfExists('event_updates');
    }
}
