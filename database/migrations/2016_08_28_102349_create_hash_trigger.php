<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER `worksheets_hash_trigger` BEFORE INSERT ON `worksheets` FOR EACH ROW
            BEGIN
                SET NEW.`hash` = MD5(CONCAT(NEW.`client`, NEW.`project`, NEW.`task`, NEW.`description`, NEW.`start`, NEW.`end`, NEW.`duration`, NEW.`tags`, NEW.`amount`, NEW.`currency`, NEW.`billable`));
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `worksheets_hash_trigger`');
    }
}
