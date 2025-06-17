<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'role' => 'Admin',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'role' => 'Kasir',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Koki',
                'email' => 'koki@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'role' => 'Koki',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pelayan',
                'email' => 'pelayan@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'role' => 'Pelayan',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'),
                'role' => 'Owner',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
