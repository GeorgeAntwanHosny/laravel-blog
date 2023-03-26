<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/about',[HomeController::class,'about'])->name('about');

Route::get('/posts_comments/{post}',[PostController::class,'show_comments'])->name('show_post_comments');
//
Route::resource('posts', PostController::class)->except([
    'index'
])->middleware('auth');
Route::get('/comments-post/{post}',[CommentController::class,'createCommentByPostID'])->name('comments.create');

Route::resource('comments', CommentController ::class)->except([
    'index','create'
])->middleware('auth');

Route::match(['get', 'post'], '/register', [AuthController::class, 'register'])->name('register')->middleware('guest');

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login')->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
