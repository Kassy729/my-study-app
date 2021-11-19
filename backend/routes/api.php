<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/store', [PostController::class, 'store']);

Route::get('/main', [PostController::class, 'mainIndex']);

Route::get('/index', [PostController::class, 'index']);

Route::get('/show/{id}', [PostController::class, 'show']);

Route::post('/update/{id}', [PostController::class, "update"]);

Route::delete('/{id}', [PostController::class, "destroy"]);

Route::post('/comment/{id}', [CommentController::class, "store"]);

Route::get('/comment/{id}', [CommentController::class, "index"]);

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/login', [LoginController::class, 'authenticate']);
