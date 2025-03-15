<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\front\HomeControlle;
use App\Http\Controllers\TagContronller;
use App\Http\Controllers\UserController; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeControlle::class, 'index'])->name('front.index');
Route::get('/About', [HomeControlle::class, 'about'])->name('front.about');
Route::get('/Contact', [HomeControlle::class, 'contact'])->name('front.contact');
Route::get('/Show/{id}',[HomeControlle::class, 'show'])->name('front.show');
Route::post('/contact',[HomeControlle::class, 'contactMessage'])->name('front.message');



Route::get('/posts/search' , [PostController::class , 'search'] )->name('posts.search');

Route::middleware('auth')->group(function(){
    Route::get('/posts', [PostController::class , 'index'])->name('posts.index');
    Route::get('/posts/create' , [PostController::class , 'create'] )->name('posts.create');
    Route::post('/posts',[PostController::class , 'store'])->name('posts.store');
    Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');
    Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update');
    Route::get('/posts/{post}/edit' , [PostController::class , 'edit'] )->name('posts.edit');
    Route::delete('/posts/{post}' , [PostController::class , 'destroy'] )->name('posts.destroy');
    
    
    Route::resource('users',UserController::class)->middleware('can:admin-controlle');
    Route::get('/user/{id}/posts',[UserController::class, 'posts'])->name('users.posts')->middleware('can:admin-controlle');
    
    
    Route::resource('tags',TagContronller::class)->middleware('can:admin-controlle');
    Route::get('/tag/{id}/posts',[TagContronller::class, 'posts'])->name('tags.posts')->middleware('can:admin-controlle');
    
});

Auth::routes();


