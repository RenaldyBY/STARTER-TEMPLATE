<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

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

// Route::get('/', function ($book) {
//     $book = Book::all();
//     return view('index', compact('book'));
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'landing'])->name('index');

Route::get('admin/home' , [App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');

Route::get('admin/books', [App\Http\Controllers\AdminController::class, 'books'])
    ->name('admin.books')
    ->middleware('is_admin');
    Route::get('/admin/ajaxadmin/dataBuku/{id}', [App\Http\Controllers\AdminController::class, 'getDataBuku'])
    ->middleware('is_admin');

//PENGELOLAAN BUKU
Route::post('admin/books',[App\Http\controllers\AdminController::class, 'submit_book'])
    ->name('admin.book.submit')
    ->middleware('is_admin');

Route::patch('admin/books/update', [App\Http\Controllers\AdminController::class, 'update_book'])
    ->name('admin.book.update')
    ->middleware('is_admin');

Route::post('admin/books/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete_book'])
    ->name('admin.book.delete')
    ->middleware('is_admin');

Route::get('admin/print_books',[App\Http\Controllers\AdminController::class, 'print_books'])
    ->name('admin.print.books')
    ->middleware('is_admin');

Route::get('admin/books/export', [App\Http\Controllers\AdminController::class, 'export'])
    ->name('admin.book.export')->middleware('is_admin');

Route::post('admin/books/import', [App\Http\Controllers\AdminController::class, 'import'])
    ->name('admin.book.import')->middleware('is_admin');

Route::get('admin/trash' , [App\Http\Controllers\trashController::class, 'index'])
    ->name('admin.trash')
    ->middleware('is_admin');