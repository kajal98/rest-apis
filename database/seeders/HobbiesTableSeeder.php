<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use DB;

class HobbiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('hobbies')->insert([
            'name' => 'Hobby 1',
            'slug' => 'hobby_1',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 2',
            'slug' => 'hobby_2',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 3',
            'slug' => 'hobby_3',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 4',
            'slug' => 'hobby_4',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 5',
            'slug' => 'hobby_5',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 6',
            'slug' => 'hobby_6',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 7',
            'slug' => 'hobby_7',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 8',
            'slug' => 'hobby_8',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 9',
            'slug' => 'hobby_9',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Hobby 10',
            'slug' => 'hobby_10',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);
    }
}
