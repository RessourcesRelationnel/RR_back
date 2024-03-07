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
        $article = Article::create([
            'title' => 'Article 1',
            'content' => 'La mere madeleine',
            'user_id' => 1,
            'validated' => 1
        ]);

        $article->categories()->attach(1);

        $article = Article::create([
            'title' => 'Article 2',
            'content' => 'La marie madeleine',
            'user_id' => 1,
            'validated' => 1
        ]);

        $article->categories()->attach(1);

        $article = Article::create([
            'title' => 'Article 3',
            'content' => 'Le pere madeleine',
            'user_id' => 2,
            'validated' => 1
        ]);

        $article->categories()->attach(1);

        $article = Article::create([
            'title' => 'Article 4',
            'content' => 'La madeleine',
            'user_id' => 2,
            'validated' => 1
        ]);

        $article->categories()->attach(1);

        $article = Article::create([
            'title' => 'Article 5',
            'content' => 'La mere VV',
            'user_id' => 1,
            'validated' => 1
        ]);

        $article->categories()->attach(1);

        $article = Article::create([
            'title' => 'Article 2',
            'content' => 'Le pere madeleine',
            'user_id' => 1,
            'validated' => 1
        ]);

        $article->categories()->attach(2);

        Article::create([
            'title' => 'Article 3',
            'content' => 'Le fils madeleineLe fils madeleineLe fils madeleineLe fils madeleineLe madeleineLemadeleineLemadeleineLemadeleineLe',
            'user_id' => 1,
            'validated' => 1
        ]);

        Article::create([
            'title' => 'Salut seb',
            'content' => 'Je suis secretement amoureux de toi ..',
            'user_id' => 1,
            'validated' => 1
        ]);

        Article::create([
            'title' => 'Salut seb',
            'content' => 'Je suis secretement amoureux de toi ..',
            'user_id' => 1,
            'validated' => 1
        ]);
    }
}
