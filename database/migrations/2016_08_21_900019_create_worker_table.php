<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name', 45);
            $table->string('email', 255)->unique();
            $table->string('address');
            $table->string('type');
            $table->string('job', 255);
            $table->timestamp('birthday');
            $table->integer('rate');
            $table->text('note');
            $table->string('gdrive');
            $table->string('status');
            $table->string('bank');
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
        Schema::drop('workers');
    }
}
