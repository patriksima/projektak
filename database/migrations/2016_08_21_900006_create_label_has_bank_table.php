<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelHasBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_has_banks', function (Blueprint $table) {
            $table->bigInteger('label_id')->unsigned();
            $table->bigInteger('bank_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('label_has_banks', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
            $table->dropForeign(['label_id']);
        });

        Schema::drop('label_has_banks');
    }
}
