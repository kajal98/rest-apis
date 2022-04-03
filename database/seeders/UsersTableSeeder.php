<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'slug' => 'super',
            'email' => 'super_admin@gmail.com',
            'email_verified_at' => now(),
            'role' => 'super_admin',
            'password' => Hash::make('restApis22'),
            'status' => 1,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Test',
            'last_name' => 'User',
            'slug' => 'test',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'role' => 'user',
            'password' => Hash::make('restApis22'),
            'status' => 1,
            'hobby_ids' => "[1,2,3]",
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Test 2',
            'last_name' => 'User 2',
            'slug' => 'test-2',
            'email' => 'user2@gmail.com',
            'email_verified_at' => now(),
            'role' => 'user',
            'password' => Hash::make('restApis22'),
            'status' => 1,
            'hobby_ids' => "[1,2,5,6]",
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Test 3',
            'last_name' => 'User 3',
            'slug' => 'test-3',
            'email' => 'user3@gmail.com',
            'email_verified_at' => now(),
            'role' => 'user',
            'password' => Hash::make('restApis22'),
            'status' => 1,
            'hobby_ids' => "[4,5,6]",
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
