<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'sofia',
            'email' => 'sofia@gmail.com',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name' => 'lidya',
            'email' => 'lidya@gmail.com',
            'password' => bcrypt('12345')
        ]);

        Category::factory(100)->create();
    }
}
