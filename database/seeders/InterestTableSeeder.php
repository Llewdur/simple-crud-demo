<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\Language;
use Illuminate\Database\Seeder;

class InterestTableSeeder extends Seeder
{
    public function run()
    {
        Interest::factory()->count(50)->create();
    }
}
