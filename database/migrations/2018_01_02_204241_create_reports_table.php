<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('send_campaign_id', 255);
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('bunch_id');
            $table->unsignedInteger('template_id');

            $table->unsignedInteger('mail_all');
            $table->unsignedInteger('mail_sent')->nullable();
            $table->unsignedInteger('mail_queued')->nullable();

            $table->unsignedInteger('mail_accepted')->nullable();
            $table->unsignedInteger('mail_rejected')->nullable();
            $table->unsignedInteger('mail_delivered')->nullable();
            $table->unsignedInteger('mail_failed')->nullable();
            $table->unsignedInteger('mail_opened')->nullable();
            $table->unsignedInteger('mail_unsubscribed')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->foreign('bunch_id')->references('id')->on('bunches');
            $table->foreign('template_id')->references('id')->on('templates');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
