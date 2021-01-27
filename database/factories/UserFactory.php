<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
            'idnumber' => $this->faker->unique()->randomDigit,
            'language_id' => Language::inRandomOrder()->firstOrFail()->id,
            'mobile' => $this->faker->phoneNumber,
            'name' => $this->faker->firstName,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'surname' => $this->faker->lastName,
            'remember_token' => Str::random(10),
        ];
    }
}
