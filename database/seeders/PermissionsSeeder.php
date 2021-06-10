<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'permissions.parents',   'allow_read' => '1', 'allow_write' => '1', 'allow_share' => '1',],
            ['name' => 'permissions.relatives', 'allow_read' => '1', 'allow_write' => '1', 'allow_share' => '0',],
            ['name' => 'permissions.friends',    'allow_read' => '1', 'allow_write' => '0', 'allow_share' => '0',],
        ]);
    }
}
