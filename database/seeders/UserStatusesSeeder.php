<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_status')->insert([
           ['name' => 'user_statuses.paid',     'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
           ['name' => 'user_statuses.not_paid', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
           ['name' => 'user_statuses.banned',   'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
