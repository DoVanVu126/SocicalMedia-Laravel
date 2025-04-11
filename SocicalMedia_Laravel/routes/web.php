<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');


Route::get('/', [HomeController::class, 'index'])->name('home');

