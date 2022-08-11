<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OnlineController;
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

//Online
Route::get('/online', [OnlineController::class, 'online'])->name('online');
Route::prefix('online')->name('online.')->group(function(){
    Route::get('/create/{idBook}',[OnlineController::class, 'create'])->name('create');
    Route::post('/store',[OnlineController::class, 'store'])->name('store');
});

//Login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login-process', [LoginController::class, 'process'])->name('login-process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Dashboard
Route::middleware([CheckLogin::class])->group(function () {

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/export/{month}', [DashboardController::class, 'export'])->name('export-excel');
    Route::get('/dashboard/exportByYear/{year}', [DashboardController::class, 'exportByYear'])->name('exportByYear');
    Route::get('/lostBook/{idBB}/{status}', [DashboardController::class, 'lostBook'])->name('lostBook');
    Route::get('/preview/{month}',[DashboardController::class, 'preview'])->name('preview');


    Route::prefix('book')->name('book.')->group(function () {
        Route::get('/insert-by-excel', [BookController::class, 'insertByExcel'])->name('insert-by-excel');
        Route::post('/insert-by-excel-process', [BookController::class, 'insertByExcelProcess'])->name('insert-by-excel-process');
        Route::get('/export', [BookController::class, 'export'])->name('export-excel');
        Route::get('/storage', [BookController::class, 'storage'])->name('storage');
    });


    Route::get('/add-image/{idBook}', [BookController::class, 'addImage'])->name('add-image');
    Route::post('/save-image', [BookController::class, 'saveImage'])->name('save-image');

    Route::resource('book', BookController::class);


    Route::prefix('bbook')->name('bbook.')->group(function () {
        Route::get('/get-books/{id}', [BBookController::class, 'getAllBookById'])->name('get-books');
        Route::get('/get-student/{id}', [BBookController::class, 'getAllInfoById'])->name('get-student');
        Route::get('/createBB', [BBookController::class, 'createBB'])->name('createBB');
        Route::get('/createBB/get-student-by-id/{id}', [BBookController::class, 'getStudentById'])->name('get-student-by-id');
        Route::get('/createBB/get-book-by-id/{id}', [BBookController::class, 'getBookById'])->name('get-book-by-id');
        Route::post('/saveBB', [BBookController::class, 'saveBB'])->name('saveBB');
        Route::get('/standby', [BBookController::class, 'standby'])->name('standby');
        Route::get('/standby-status/{idBB}/{status}', [BBookController::class, 'standbyStatus'])->name('standby-status');
        Route::post('/charge',[BBookController::class, 'charge'])->name('charge');
        Route::get('/standby/removeBBook/{idBB}',[BBookController::class, 'removeBBook'])->name('removeBBook');
    });

    Route::resource('bbook', BBookController::class);

    Route::resource('rbook', RBookController::class);

    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/insert-by-excel', [StudentController::class, 'insertByExcel'])->name('insert-by-excel');
        Route::post('/insert-by-excel-process', [StudentController::class, 'insertByExcelProcess'])->name('insert-by-excel-process');
        Route::get('/export', [StudentController::class, 'export'])->name('export-excel');
        Route::get('/extend-card', [StudentController::class, 'extendCard'])->name('extend-card');
    });

    Route::get('/student/word-export/{id}', [StudentController::class, 'wordExport'])->name('word-export');

    Route::resource('student', StudentController::class);

    Route::get('/get-status/{idBB}/{status}', [HistoryController::class, 'getStatus'])->name('get-status');

    Route::resource('history', HistoryController::class);

    Route::resource('author', AuthorController::class);

    Route::resource('category', CategoryController::class);

    Route::resource('shelf', ShelfController::class);
});
