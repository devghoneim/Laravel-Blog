<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 


Route::get('/', [PostController::class, 'home']);

Route::get('/posts', [PostController::class , 'index'])->name('posts.index');

Route::get('/posts/create' , [PostController::class , 'create'] )->name('posts.create');
Route::get('/posts/search' , [PostController::class , 'search'] )->name('posts.search');
Route::post('/posts',[PostController::class , 'store'])->name('posts.store');
Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');
Route::get('/posts/{post}/edit' , [PostController::class , 'edit'] )->name('posts.edit');
Route::delete('/posts/{post}' , [PostController::class , 'destroy'] )->name('posts.destroy');
