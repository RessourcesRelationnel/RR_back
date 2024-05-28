<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Sport',
        ]);

        Category::create([
            'name' => 'culture',
        ]);

        Category::create([
            'name' => 'combat',
        ]);

        Category::create([
            'name' => 'prof',
        ]);
    }
}
