<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RolesTableSeeder::class,
            UserSeeder::class,
            StatusSeeder::class,
        ]);


    }
}
