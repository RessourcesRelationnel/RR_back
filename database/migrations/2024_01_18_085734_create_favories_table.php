<?php

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favories', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Article::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorite');
    }
};
