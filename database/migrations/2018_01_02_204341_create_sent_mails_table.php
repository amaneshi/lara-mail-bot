<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message_id', 100)->nullable();
            $table->integer('report_id')->unsigned();
            $table->integer('subscriber_id')->unsigned();

            $table->boolean('mail_opened')->nullable();
            $table->boolean('mail_unsubscribed')->nullable();
            $table->string('mail_unsubscribe_reason')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sent_mails');
    }
}
