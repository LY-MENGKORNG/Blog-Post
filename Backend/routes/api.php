<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user routes
Route::post('/user/create', [UserController::class, 'store'])->name('user.create');

// post routes
Route::post('/posts/create', [PostController::class, 'store'])->name('posts.create');
Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/delete/{id}', [PostController::class, 'destroy'])->name('posts.delete');