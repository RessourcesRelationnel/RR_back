<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/article/index', [ArticlesController::class, 'index']);


Route::group(['middleware' => ['guest']], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::post('/article/create', [ArticlesController::class, 'store']);
    Route::post('/article/edit/{article}', [ArticlesController::class, 'edit']);

    Route::prefix('admin/')->group( function(){
        Route::get('shows/moderator', [AdminController::class, 'showModerator']);
        Route::get('promote-user/{user}', [AdminController::class, 'promoteUser']);

        Route::middleware(['can:validate_article'])->group(function () {
            Route::get('shows/unvalidated', [AdminController::class, 'showUnvalidateArticles']);
            Route::get('article/{article}/validate', [AdminController::class, 'validateArticle']);
        });
            Route::get('shows/admin', [AdminController::class, 'showAdmin']);
            Route::get('shows/moderator', [AdminController::class, 'showModerator']);
    });
});

