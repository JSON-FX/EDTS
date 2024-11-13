<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->Increments('id');
            $table->date('date_of_entry');
            $table->string('reference_id');
            $table->string('sub_reference_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('process_types_id')->nullable()->unsigned()->index();
            $table->integer('offices_id')->nullable()->unsigned()->index();            
            $table->integer('pr_descriptions_id')->nullable()->unsigned()->index();
            $table->decimal('amount', 15, 2);
            $table->decimal('pr_actual_amount', 15, 2)->nullable();
            $table->string('client')->nullable();
            $table->string('address')->nullable();
            $table->integer('canvassers_id')->nullable()->unsigned()->index();
            $table->integer('statuses_id')->nullable()->unsigned()->index();
            $table->integer('users_id')->nullable()->unsigned()->index();
            $table->string('endorsement_date');
            $table->timestamps();

            $table->foreign('process_types_id')
              ->references('id')
              ->on('process_types')
              ->onDelete('cascade');

            $table->foreign('offices_id')
              ->references('id')
              ->on('offices')
              ->onDelete('cascade');

            $table->foreign('canvassers_id')
              ->references('id')
              ->on('canvassers')
              ->onDelete('cascade');

            $table->foreign('pr_descriptions_id')
              ->references('id')
              ->on('pr_descriptions')
              ->onDelete('cascade');

            $table->foreign('statuses_id')
              ->references('id')
              ->on('statuses');

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
        Schema::dropIfExists('transactions');
    }
}
