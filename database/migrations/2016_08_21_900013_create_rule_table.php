<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 45);
            $table->text('sql');
            $table->timestamps();
        });

        Schema::table('label_has_rules', function (Blueprint $table) {
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign(['rule_id']);
        });

        Schema::drop('rules');
    }
}
