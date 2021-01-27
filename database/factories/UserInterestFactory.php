<?php

namespace Database\Factories;

use App\Models\Interest;
use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserInterestFactory extends Factory
{
    protected $model = UserInterest::class;

    public function definition()
    {
        return [
            'interest_id' => Interest::inRandomOrder()->firstOrFail()->id,
            'user_id' => User::firstOrFail()->id,
        ];
    }
}
