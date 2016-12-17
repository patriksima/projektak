<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('slug', 45);
            $table->smallInteger('order');
            $table->timestamps();
        });

        DB::table('project_statuses')->insert([
            [
                'name'  => 'Aktivní',
                'slug'  => 'active',
                'order' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'  => 'Neaktivní',
                'slug'  => 'inactive',
                'order' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_statuses');
    }
}
