<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerHasTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_has_tasks', function (Blueprint $table) {
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('task_id')->unsigned();

            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('worker_has_tasks', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
            $table->dropForeign(['worker_id']);
        });

        Schema::drop('worker_has_tasks');
    }
}
