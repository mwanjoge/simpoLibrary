<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('book/favourite/toggle/{id}', [App\Http\Controllers\BookController::class, 'toggleFavourite'])->name('book.favourite.toggle');
Route::resource('books', App\Http\Controllers\BookController::class);


Route::resource('favourites', App\Http\Controllers\FavouriteController::class);


Route::resource('comments', App\Http\Controllers\CommentController::class);


Route::resource('users', App\Http\Controllers\UserController::class);
