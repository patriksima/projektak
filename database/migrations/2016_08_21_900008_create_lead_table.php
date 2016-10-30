<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned()->nullable()->default(null);
            $table->integer('status_id')->unsigned();
            $table->integer('reason_id')->unsigned()->nullable()->default(null);
            $table->string('client', 255)->nullable()->default(null);
            $table->string('contact', 255)->nullable()->default(null);
            $table->string('source', 255)->nullable()->default(null);
            $table->string('needs', 255)->nullable()->default(null);
            $table->integer('budget')->nullable()->default(null);
            $table->text('background')->nullable()->default(null);
            $table->text('gdrive')->nullable()->default(null);
            $table->enum('dealstatus', ['unknown', 'win', 'lose'])->nullable()->default('unknown');
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
        Schema::drop('leads');
    }
}
