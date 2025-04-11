<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');

Route::get('create', [CrudUserController::class, 'createUser'])->name('user.createUser');
Route::post('create', [CrudUserController::class, 'postUser'])->name('user.postUser');

Route::get('read', [CrudUserController::class, 'readUser'])->name('user.readUser');

Route::get('delete', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');

Route::get('update', [CrudUserController::class, 'updateUser'])->name('user.updateUser');
Route::post('update', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');

Route::get('list', [CrudUserController::class, 'listUser'])->name('user.list');

Route::get('signout', [CrudUserController::class, 'signOut'])->name('signout');


Route::get('notifications/view-alt', [NotificationController::class, 'viewAlt'])->name('notifications.viewAlt');

Route::resource('notifications', NotificationController::class);

Route::get('notifications/delete', [NotificationController::class, 'deleteNotification'])->name('notifications.delete');
Route::get('/notifications/check-new', [NotificationController::class, 'checkNew'])->name('notifications.check');


Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::get('/posts/destroy', [PostController::class, 'create'])->name('post.destroy');
Route::post('/posts', [PostController::class, 'store'])->name('post.store');
