<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->hasUserInterests(1)
            ->create([
                'email' => User::TESTS_EMAIL,
                'mobile' => User::TESTS_MOBILE,
                'name' => User::TESTS_NAME,
                'password' => Hash::make(User::TESTS_PASSWORD),
                'surname' => User::TESTS_SURNAME,
            ]);
    }
}
