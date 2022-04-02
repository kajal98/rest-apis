<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
            'name' => 'Doctorate',
            'slug' => 'Doctorate',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'PhD',
            'slug' => 'PhD',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Master of Arts (MA)',
            'slug' => 'Master of Arts (MA)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Master of Science (MSc)',
            'slug' => 'Master of Science (MSc)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Master of engineering (MEng)',
            'slug' => 'Master of engineering (MEng)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Post Graduate Diploma',
            'slug' => 'Post Graduate Diploma',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Post Graduate Certificate',
            'slug' => 'Post Graduate Certificate',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Post Graduate Certificate in Education',
            'slug' => 'Post Graduate Certificate in Education',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Bachelor of Science (BSc)',
            'slug' => 'Bachelor of Science (BSc)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Bachelor of Art (BA)',
            'slug' => 'Bachelor of Art (BA)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Bachelor in Education (BEd)',
            'slug' => 'Bachelor in Education (BEd)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Bachelor in Engineering (BEng)',
            'slug' => 'Bachelor in Engineering (BEng)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Graduate Diploma',
            'slug' => 'Graduate Diploma',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Graduate Certificate',
            'slug' => 'Graduate Certificate',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Bachelor Degree',
            'slug' => 'Bachelor Degree',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Higher National Diploma (HND)',
            'slug' => 'Higher National Diploma (HND)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Certificate of Higher Education (CertHE)',
            'slug' => 'Certificate of Higher Education (CertHE)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'Higher National Certificate (HNC)',
            'slug' => 'Higher National Certificate (HNC)',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);

        DB::table('hobbies')->insert([
            'name' => 'A Level',
            'slug' => 'A Level',
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
        ]);
    }
}
