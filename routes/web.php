<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// Register
Route::get('/register', [LoginController::class, 'register'])->middleware('guest');
Route::post('/register', [LoginController::class, 'store_register']);

// Home
Route::get('/', [Controller::class, 'index']);
Route::get('/indeks', [Controller::class, 'indeks']);
Route::get('/read/{post:slug}', [Controller::class, 'read']);
Route::get('/profile', [Controller::class, 'profile'])->middleware('auth');
Route::put('/profile/update/{id}', [Controller::class, 'profile_update'])->middleware('auth');
Route::get('/users', [Controller::class, 'users'])->middleware('auth');
Route::put('/users/update/{id}', [Controller::class, 'users_update'])->middleware('auth');
Route::put('/users/demotion/{id}', [Controller::class, 'users_demotion'])->middleware('auth');
Route::get('/recPosts', [Controller::class, 'recPosts'])->middleware('auth');
Route::get('/recPosts/update/{id}', [Controller::class, 'recPosts_update'])->middleware('auth');
Route::get('/recPosts/demotion/{id}', [Controller::class, 'recPosts_demotion'])->middleware('auth');
Route::get('/posts/action/{id}', [Controller::class, 'action'])->middleware('auth');
Route::get('/posts/bookmark/{id}', [Controller::class, 'bookmark'])->middleware('auth');
Route::get('/saved/{user:username}', [Controller::class, 'postBookmark'])->middleware('auth');
Route::get('/liked/{user:username}', [Controller::class, 'postLike'])->middleware('auth');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'Dashboard'
    ]);
})->middleware('auth');
Route::resource('/dashboard/posts', DashboardController::class)->middleware('auth');

Route::get('/dashboard/category/checkSlug', [CategoryController::class, 'checkSlug']);
Route::resource('/dashboard/category', CategoryController::class)->middleware('auth');
