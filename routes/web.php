<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RBookController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\StudentController;
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
    return view('dashboard');
});

Route::resource('book',BookController::class);

Route::resource('bbook',BBookController::class);

Route::resource('rbook',RBookController::class);

Route::resource('student', StudentController::class);

Route::resource('history', HistoryController::class);

Route::resource('author', AuthorController::class);

Route::resource('category', CategoryController::class);

Route::resource('shelf', ShelfController::class);
