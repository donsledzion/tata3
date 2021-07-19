<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRequestsToFollowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests_to_follow', function (Blueprint $table) {
            $table->unique(array('account_id','requesting_id'),'unique_account_id_requesting_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests_to_follow', function (Blueprint $table) {
            $table->dropUnique('unique_account_id_requesting_id');
        });
    }
}
