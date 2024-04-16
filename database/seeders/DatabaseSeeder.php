<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Uncomment the line below to seed the 'products' table with 10 records using the Product model factory
        \App\Models\Product::factory(50)->create();

        // Creates a single admin user with specific details using the Admin model factory
        // \App\Models\Admin::factory()->create([
        //     'name' => 'TestUser', // Sets the name of the admin user
        //     'email' => 'test@example.com', // Sets the email address of the admin user
        //     'password'=>bcrypt('thisisadmin'), // Sets the password of the admin user (Note: Should be bcrypt instead of bycrypt)
        //     'role'=>"super_admin" // Sets the role of the admin user
        // ]);
    }
}
