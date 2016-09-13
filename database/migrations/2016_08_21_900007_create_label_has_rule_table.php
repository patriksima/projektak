<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelHasRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_has_rules', function (Blueprint $table) {
            $table->bigInteger('label_id')->unsigned();
            $table->bigInteger('rule_id')->unsigned();

            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('label_has_rules', function (Blueprint $table) {
            $table->dropForeign(['label_id']);
        });

        Schema::drop('label_has_rules');
    }
}
