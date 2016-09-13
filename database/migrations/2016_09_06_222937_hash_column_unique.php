<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HashColumnUnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worksheets', function (Blueprint $table) {
            // $table->char('hash', 32)->unique()->change();
            DB::statement('ALTER TABLE `worksheets` ADD UNIQUE `worksheets_hash_unique` (`hash`)');
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
            // $table->dropUnique('worksheets_hash_unique');
            DB::statement('ALTER TABLE `worksheets` DROP INDEX `worksheets_hash_unique`');
        });
    }
}
