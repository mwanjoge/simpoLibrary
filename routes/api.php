<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginAPIController;

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

Route::post('register', [LoginAPIController::class, 'register']);
Route::post('login', [LoginAPIController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user-detail', [LoginAPIController::class, 'userDetail']);
    Route::post('logout', [LoginAPIController::class, 'logout']);
    Route::resource('books', App\Http\Controllers\API\BookAPIController::class);
    Route::get('favourites/books', [App\Http\Controllers\API\BookAPIController::class, 'mostLikedBooks']);
    Route::resource('favourites', App\Http\Controllers\API\FavouriteAPIController::class);
    Route::resource('comments', App\Http\Controllers\API\CommentAPIController::class);
});

