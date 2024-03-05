<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentariesController;
use App\Http\Controllers\CategoriesController;
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
Route::get('/commentary/index/{article}', [CommentariesController::class, 'index']);

Route::group(['middleware' => ['guest']], function () {
    //   -------------------------------------Auth routes --------------------------------
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    //   -------------------------------------Article routes --------------------------------
    Route::get('/article/index', [ArticlesController::class, 'indexArticleValidated'])->name('article.index');
    Route::post('/article/create', [ArticlesController::class, 'store'])->name('article.store');

//    rajouter une verification puisque l'user peut seulement modifier son article a lui
//    surement dans un policies
    Route::post('/article/edit/{article}', [ArticlesController::class, 'update'])->name('article.update');

    //   -------------------------------------Categories routes --------------------------------
    Route::get('/category/index', [CategoriesController::class, 'index'])->name('category.index');

    //   -------------------------------------Commentary routes --------------------------------
    Route::post('/commentary/add/{article}', [CommentariesController::class, 'store'])->name('commentary.store');

    //   ------------------------------------- Administration routes --------------------------------
    Route::prefix('administration/')->group(function(){

        //   -------------------------------------Super-admin routes --------------------------------

        Route::get('revoke-moderator/{user}', [UserController::class, 'revokeAdmin'])->middleware(['can:revoke_admin'])->name('revoke_admin');
        Route::get('delete-article/{article}', [ArticlesController::class, 'destroy'])->middleware(['can:delete_article'])->name('delete_article');

        //   -------------------------------------Admin routes --------------------------------

        Route::get('promote-to-moderator/{user}', [UserController::class, 'promoteToModerator'])->middleware(['can:promote_moderator']);
        Route::get('revoke-moderator/{user}', [UserController::class, 'revokeModerator'])->middleware(['can:revoke_moderator']);

        Route::middleware(['can:create_delete_category'])->group(function () {
            Route::get('delete-category/{category}', [CategoriesController::class, 'destroy'])->name('delete-category');
            Route::get('create-category/', [CategoriesController::class, 'store'])->name('create-category');
        });

        //   -------------------------------------Moderator routes --------------------------------

        Route::middleware(['can:validate_article'])->group(function () {
            Route::get('shows/unvalidated', [UserController::class, 'getUnvalidateArticles'])->name('get-unvalidate-articles');
            Route::get('article/{article}/validate', [UserController::class, 'validateArticle'])->name('validate-article');
        });

        Route::get('delete-comment/{commentary}', [CommentariesController::class, 'destroy'])->middleware(['can:delete_comment']);

        //          --------------Categories routes ---------------

        Route::post('/category/create', [CategoriesController::class, 'store'])->name('category.store');
        Route::middleware(['can:can_see_dashboard'])->group(function () {


            Route::post('/category/edit/{category}', [CategoriesController::class, 'updateCategory'])->name('category.update');

            Route::get('get/admin', [UserController::class, 'getAdmin']);
            Route::get('get/moderator', [UserController::class, 'getModerator']);

            //          -------------------------------------Articles routes --------------------------------
            Route::get('/article/index-article-not-validated', [ArticlesController::class, 'indexArticleNotValidated'])->name('article.indexArticleNotValidated');
        });
    });
});

