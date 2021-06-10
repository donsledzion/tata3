<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PostStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_status')->insert([
            ['name' => 'post_statuses.private',    'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),],
            ['name' => 'post_statuses.relatives',  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'post_statuses.friends',    'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'post_statuses.public',     'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
