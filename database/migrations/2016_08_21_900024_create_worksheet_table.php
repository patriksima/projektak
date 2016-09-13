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
            $table->bigIncrements('id');
            $table->bigInteger('project_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('worker_id')->unsigned();
            $table->string('client', 45);
            $table->string('project', 45);
            $table->text('task');
            $table->text('description');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->decimal('duration', 10, 2);
            $table->string('tags', 255);
            $table->decimal('amount', 10, 2);
            $table->char('currency', 3);
            $table->boolean('billable');
            $table->binary('hash', 16);
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('no action')->onUpdate('no action');
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('worksheets', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['worker_id']);
        });

        Schema::drop('worksheets');
    }
}
