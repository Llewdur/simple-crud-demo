<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            LanguageTableSeeder::class,
            InterestTableSeeder::class,
            UserTableSeeder::class,
            UserInterestTableSeeder::class,
        ]);
    }
}
