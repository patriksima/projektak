<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHashType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worksheets', function (Blueprint $table) {
            //$table->char('hash', 32)->change(); // because bug https://github.com/laravel/framework/issues/9636
            DB::statement('ALTER TABLE `worksheets` CHANGE `hash` `hash` char(32) NOT NULL AFTER `billable`;');
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
            //$table->binary('hash', 16)->change();
            DB::statement('ALTER TABLE `worksheets` CHANGE `hash` `hash` blob NOT NULL AFTER `billable`;');
        });
    }
}
