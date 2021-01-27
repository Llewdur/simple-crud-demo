<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()
        // ->hasUserInterests(1, [
        //     'name' => 'some interest'
        // ])
        ->create([
            'email' => User::TESTS_EMAIL,
            'mobile' => User::TESTS_MOBILE,
            'name' => User::TESTS_NAME,
            'password' => User::TESTS_PASSWORD,
            'surname' => User::TESTS_SURNAME,
        ]);
    }
}
