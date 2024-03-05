<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentariesController;
use \App\Http\Controllers\CategoriesController;
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
Route::get('/categories/index', [CategoriesController::class, 'index']);
Route::get('/commentary/index/{article}', [CommentariesController::class, 'index']);


Route::group(['middleware' => ['guest']], function () {
    //   -------------------------------------Auth routes --------------------------------
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    //   -------------------------------------Article routes --------------------------------
    Route::post('/article/create', [ArticlesController::class, 'store']);
    Route::post('/article/edit/{article}', [ArticlesController::class, 'update']);

    //   -------------------------------------Commentary routes --------------------------------
    Route::post('/commentary/add/{article}', [CommentariesController::class, 'store']);

    //   -------------------------------------Admin routes --------------------------------
    Route::prefix('admin/')->group( function(){
        Route::middleware(['can:can_see_dashboard'])->group(function () {

            Route::get('shows/admin', [AdminController::class, 'showAdmin']);
            Route::get('shows/moderator', [AdminController::class, 'showModerator']);

            Route::middleware(['can:validate_article'])->group(function () {
                Route::get('shows/unvalidated', [AdminController::class, 'showUnvalidateArticles']);
                Route::get('article/{article}/validate', [AdminController::class, 'validateArticle']);
            });

            Route::get('category/create', [CategoriesController::class, 'store']);

            Route::middleware(['can:promote_moderator'])->group(function () {
                Route::get('promote-to-moderator/{user}', [AdminController::class, 'promoteToModerator']);
            });

            Route::middleware(['can:revoke_moderator'])->group(function () {
                Route::get('revoke_moderator/{user}', [AdminController::class, 'revokeModerator']);
            });

            Route::middleware(['can:revoke_admin'])->group(function () {
                Route::get('revoke_moderator/{user}', [AdminController::class, 'revokeModerator']);
            });

        });
    });
});

