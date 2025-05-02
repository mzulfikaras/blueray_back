<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'      => 'Adminstrator',
                'email'     => 'admin@email.com',
                'password'  => bcrypt('admin12345'),
                'role_id'   => 1,
            ],
            [
                'name'      => 'User',
                'email'     => 'user@email.com',
                'password'  => bcrypt('user12345'),
                'role_id'   => 2,
            ]
        ]);
    }
}
