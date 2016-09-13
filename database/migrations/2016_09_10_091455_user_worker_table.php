<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_worker', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('worker_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('user_worker', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['worker_id']);
        });
        Schema::dropIfExists('user_worker');
    }
}
