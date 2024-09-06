<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'mohamed',
            'email' => 'mohamed@admin.com',
            'password' => Hash::make('123456'),
        ]);
        $category = Category::factory(10)->create();
        Task::factory(100)->create([
            'category_id' => $category->random()->id,
        ]);


    }
}
