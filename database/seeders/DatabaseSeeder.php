<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ]);


        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'admin',
        // ]);

        // User::factory()->create([
        //     'name' => 'Matthew',
        //     'email' => 'matt@gmail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'user',
        // ]);
        //User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'is_admin' => true,
        // ]);
    }
}
