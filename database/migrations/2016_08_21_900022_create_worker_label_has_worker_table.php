<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerLabelHasWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_label_has_workers', function (Blueprint $table) {
            $table->bigInteger('worker_label_id')->unsigned();
            $table->bigInteger('worker_id')->unsigned();

            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('worker_label_id')->references('id')->on('worker_labels')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('worker_label_has_workers', function (Blueprint $table) {
            $table->dropForeign(['worker_id']);
            $table->dropForeign(['worker_label_id']);
        });

        Schema::drop('worker_label_has_workers');
    }
}
