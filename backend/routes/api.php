<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TodoListController;
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


//개발노트
Route::post('/store', [PostController::class, 'store']);
Route::get('/main', [PostController::class, 'mainIndex']);
Route::get('/index', [PostController::class, 'index']);
Route::get('/show/{id}', [PostController::class, 'show']);
Route::post('/update/{id}', [PostController::class, "update"]);
Route::delete('/{id}', [PostController::class, "destroy"]);


//댓글
Route::post('/comment/{id}', [CommentController::class, "store"]);
Route::get('/comment/{id}', [CommentController::class, "index"]);


//회원관리
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);
Route::get('/user', [RegisterController::class, 'user']);

//todo
Route::post('/todo', [TodoListController::class, 'store']);
Route::delete('/todo/{id}', [TodoListController::class, 'destroy']);
