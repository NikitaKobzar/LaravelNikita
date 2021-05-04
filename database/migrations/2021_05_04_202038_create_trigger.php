<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER before_user_delete
	        BEFORE DELETE ON user_models
            FOR EACH ROW
            DELETE FROM product_models WHERE `user_id` = user_models.id;');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_User_Changed_Login`');
    }
}
