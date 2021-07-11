<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccountUserPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_user_permission', function(Blueprint $table){
            /*$table->dropForeign(['account_id']);
            $table->dropForeign(['user_id']);*/
            //$table->dropPrimary(['account_id','user_id']);
            $table->id()->first();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_user_permission', function(Blueprint $table){

            $table->dropPrimary();
        });
    }
}
