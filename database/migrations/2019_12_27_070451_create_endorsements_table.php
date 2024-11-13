<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndorsementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endorsements', function (Blueprint $table) {
            
            $table->Increments('id');
            $table->integer('transactions_id')->nullable()->unsigned()->index();
            $table->integer('endorsing_offices_id')->nullable()->unsigned()->index();
            $table->integer('receiving_offices_id')->nullable()->unsigned()->index();
            $table->string('date_endorsed')->nullable();
            $table->string('date_received')->nullable();
            $table->integer('statuses_id')->nullable()->unsigned()->index();
            $table->integer('action_takens_id')->nullable()->unsigned()->index();
            $table->integer('users_id')->nullable()->unsigned()->index();
            $table->timestamps();


            $table->foreign('transactions_id')
              ->references('id')
              ->on('transactions');
              
            $table->foreign('statuses_id')
              ->references('id')
              ->on('statuses');
             
            $table->foreign('endorsing_offices_id')
              ->references('id')
              ->on('endorsing_offices');

            $table->foreign('receiving_offices_id')
              ->references('id')
              ->on('receiving_offices');

            $table->foreign('action_takens_id')
              ->references('id')
              ->on('action_takens');
              
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
        Schema::dropIfExists('endorsements');
    }
}
