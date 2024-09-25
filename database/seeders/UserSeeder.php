<?php

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the role column exists in the users table
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function ($table) {
                $table->string('role')->default('user');
            });
        }

        // Create the admin user
        User::Create(
            // [ 'email' => 'admin@example.com'],
            [
            'name' => 'Admin User',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email' => 'admin@example.com'
            ], 

            [
                'name' => 'Matthew',
                'password' => bcrypt('password'),
                'role' => 'user',
                'email' => 'matthew@gmail.com'
            ],

            [
                'name' => 'Fekumoh',
                'password' => bcrypt('password'),
                'role' => 'Project Manager',
                'email' => 'fekumoh@gmail.com'
            ],

            [
                'name' => 'John',
                'password' => bcrypt('password'),
                'role' => 'editor',
                'email' => 'ojcool@gmail.com'
            ]
            
        );

        // Create regular users with default role 'user'
        User::factory()->count(10)->create([ 'role_id' => 'user_id' ]);
    }
}