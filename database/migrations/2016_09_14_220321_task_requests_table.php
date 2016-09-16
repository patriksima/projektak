<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('task_id')->unsigned();
            $table->decimal('estimate', 5, 2)->unsigned();
            $table->string('reason');
            $table->timestamps();

            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_requests');
    }
}
