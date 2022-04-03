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
            'name' => 'Acting',
            'slug' => 'acting',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Baking',
            'slug' => 'baking',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Blogging',
            'slug' => 'blogging',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Coding',
            'slug' => 'coding',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Cooking',
            'slug' => 'cooking',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Crafting',
            'slug' => 'crafting',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Dance',
            'slug' => 'dance',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Playing Games',
            'slug' => 'playing-games',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Ice skating',
            'slug' => 'ice-skating',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Listening Music',
            'slug' => 'listening-music',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Origami',
            'slug' => 'origami',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Painting',
            'slug' => 'painting',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Photography',
            'slug' => 'photography',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Quilling',
            'slug' => 'quilling',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Reading',
            'slug' => 'reading',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Watching movies',
            'slug' => 'watching-movies',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);
    }
}
