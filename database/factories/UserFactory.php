<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'dob' => $this->faker->date,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'idnumber' => Str::random(11),
            'language_id' => Language::inRandomOrder()->firstOrFail()->id,
            'mobile' => Str::random(11),
            'name' => $this->faker->firstName,
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
            'surname' => $this->faker->lastName,
        ];
    }
}
