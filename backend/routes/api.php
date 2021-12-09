<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikesController;
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
Route::get('/main', [PostController::class, 'mainIndex']);
Route::post('/store', [PostController::class, 'store']);
Route::post('/index', [PostController::class, 'index']);
Route::get('/show/{id}', [PostController::class, 'show']);
Route::post('/update/{id}', [PostController::class, "update"]);
Route::delete('/{id}', [PostController::class, "destroy"]);

// ->middleware('auth:sanctum');



//댓글
Route::post('/comment/{id}', [CommentController::class, "store"]);
Route::get('/comment/{id}', [CommentController::class, "index"]);
Route::delete('/comment/{comment_id}', [CommentController::class, 'destroy']);


//회원관리
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);
Route::post('/user', [RegisterController::class, 'user']);
Route::post('/getProfile', [RegisterController::class, 'profile']);
Route::post('/name', [RegisterController::class, 'name']);
Route::post('/editProfile', [RegisterController::class, 'edit']);


//todo
Route::post('/todo', [TodoListController::class, 'store']);
Route::post('/todoList', [TodoListController::class], 'todo');


//즐겨찾기
Route::post('/like/{post}', [LikesController::class, 'store']);
