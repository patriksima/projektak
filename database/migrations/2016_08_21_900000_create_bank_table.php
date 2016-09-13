<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->decimal('cash', 15, 2);
            $table->char('currency', 3);
            $table->string('account_num', 255)->nullable()->default(null);
            $table->string('account_name', 255)->nullable()->default(null);
            $table->integer('bank_num')->nullable()->default(null);
            $table->string('bank_name', 255)->nullable()->default(null);
            $table->integer('const_sym')->nullable()->default(null);
            $table->integer('var_sym')->nullable()->default(null);
            $table->integer('spec_sym')->nullable()->default(null);
            $table->string('description', 255)->nullable()->default(null);
            $table->string('message', 140)->nullable()->default(null);
            $table->string('type', 255);
            $table->string('user', 50)->nullable()->default(null);
            $table->string('specification', 255)->nullable()->default(null);
            $table->string('comment', 255)->nullable()->default(null);
            $table->string('bic_id', 11)->nullable()->default(null);
            $table->integer('payment_id')->nullable()->default(null);
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
        Schema::drop('banks');
    }
}
