<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'Article 1',
            'content' => 'La mere madeleine',
            'user_id' => 1,
            'validated' => 1
        ]);

        Article::create([
            'title' => 'Article 2',
            'content' => 'Le pere madeleine',
            'user_id' => 1,
            'validated' => 1
        ]);

        Article::create([
            'title' => 'Article 3',
            'content' => 'Le fils madeleine',
            'user_id' => 1,
            'validated' => 1
        ]);
    }
}
