<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdColumnSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('social_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('social_accounts', function (Blueprint $table) {
            // bug: 1075 Incorrect table definition; there can be only one auto column and it mu st be defined as a key
            //$table->dropPrimary(['id']);
        });
    }
}
