<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worksheets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('worker_id')->unsigned();
            $table->text('task');
            $table->text('description');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->decimal('duration', 10, 2);
            $table->string('tags', 255);
            $table->decimal('amount', 10, 2);
            $table->char('currency', 3);
            $table->boolean('billable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('worksheets');
    }
}
