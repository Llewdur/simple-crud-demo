<?php

namespace Database\Seeders;

use App\Models\UserInterest;
use Illuminate\Database\Seeder;

class UserInterestTableSeeder extends Seeder
{
    public function run()
    {
        UserInterest::factory()->count(1)->create();
    }
}
