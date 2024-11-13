<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('transactions_id')->unsigned()->index();
            $table->integer('endorsements_id')->unsigned()->index();
            $table->integer('attachment_lists_id')->unsigned()->index();
            $table->string('reference_id')->nullable();
            $table->timestamps();

            $table->foreign('transactions_id')
              ->references('id')
              ->on('transactions')
              ->onDelete('cascade');

            $table->foreign('endorsements_id')
              ->references('id')
              ->on('endorsements')
              ->onDelete('cascade');

            $table->foreign('attachment_lists_id')
              ->references('id')
              ->on('attachment_lists')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
