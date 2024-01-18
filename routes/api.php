<?php

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

Route::group(['middleware' => ['guest']], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::post('/article/create', [ArticlesController::class, 'store']);
    Route::post('/article/edit/{article}', [ArticlesController::class, 'edit']);

});
