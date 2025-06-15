<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wartawan',
                'email' => 'wartawan@gmail.com',
                'password' => Hash::make('wartawan'),
                'role' => 'wartawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Editor',
                'email' => 'editor@gmail.com',
                'password' => Hash::make('editor'),
                'role' => 'editor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
