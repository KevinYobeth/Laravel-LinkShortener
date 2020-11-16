<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '0',
            'name' => 'Anonymous',
            'email' => 'anonymous@klifonara.com',
            'password' => bcrypt('anonymous'),
        ]);
    }
}
