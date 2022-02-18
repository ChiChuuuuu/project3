<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RBookController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLogin;
use App\Models\BBookModel;
use Illuminate\Http\Request;
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

//Login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login-process', [LoginController::class, 'process'])->name('login-process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Dashboard
Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });


    Route::prefix('book')->name('book.')->group(function () {
        Route::get('/insert-by-excel', [BookController::class, 'insertByExcel'])->name('insert-by-excel');
        Route::post('/insert-by-excel-process', [BookController::class, 'insertByExcelProcess'])->name('insert-by-excel-process');
        Route::get('/export', [BookController::class, 'export'])->name('export-excel');
    });

    Route::resource('book', BookController::class);

    Route::prefix('bbook')->name('bbook.')->group(function () {
        Route::get('/get-books/{id}',[BBookController::class,'getAllBookById'])->name('get-books');
        Route::get('/get-student/{id}',[BBookController::class,'getAllInfoById'])->name('get-student');
    });

    Route::resource('bbook', BBookController::class);

    Route::resource('rbook', RBookController::class);

    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/insert-by-excel', [StudentController::class, 'insertByExcel'])->name('insert-by-excel');
        Route::post('/insert-by-excel-process', [StudentController::class, 'insertByExcelProcess'])->name('insert-by-excel-process');
        Route::get('/export', [StudentController::class, 'export'])->name('export-excel');
    });

    Route::get('/student/word-export/{id}', [StudentController::class, 'wordExport'])->name('word-export');

    Route::resource('student', StudentController::class);

    Route::get('/get-status/{idBB}/{status}',[HistoryController::class,'getStatus'])->name('get-status');

    Route::resource('history', HistoryController::class);

    Route::resource('author', AuthorController::class);

    Route::resource('category', CategoryController::class);

    Route::resource('shelf', ShelfController::class);
});
