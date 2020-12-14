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
            'name' => 'Kevin Yobeth',
            'username' => 'kevinyobeth',
            'email' => 'leokeviny@gmail.com',
            'password' => bcrypt('kevinyobeth'),
        ]);

        DB::table('users')->insert([
            'name' => 'KLIFONARA Binus',
            'username' => 'klifonara',
            'email' => 'klifonara@gmail.com',
            'password' => bcrypt('klifonara'),
        ]);
    }
}
