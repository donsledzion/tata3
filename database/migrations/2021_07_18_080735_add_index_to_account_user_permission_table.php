<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToAccountUserPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_user_permission', function (Blueprint $table) {
            $table->unique(array('account_id','user_id'),'unique_account_id_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_user_permission', function (Blueprint $table) {
            $table->dropUnique('unique_account_id_user_id');
        });
    }
}
