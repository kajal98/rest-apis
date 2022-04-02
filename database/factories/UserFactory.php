<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'slug' => 'super',
            'email' => 'super_admin@gmail.com',
            'email_verified_at' => now(),
            'role' => 'super_admin',
            'password' => Hash::make('restApis22'),
            'status' => 1,
            'remember_token' => Str::random(10),
        ];
    }
}
