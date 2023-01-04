<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home2Controller;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Backend\BooksController;
use App\Http\Controllers\Backend\AuthorsController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\PublishersController;
use App\Http\Controllers\Backend\PagesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersBookController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/public', [App\Http\Controllers\PagesController::class, 'index'])->name('page');
Route::resource('/book', BookController::class);
Route::get('/book/like/{book_id}', [BookController::class,'like'])->name('likebook');
Route::get('/book/read/{book_id}', [BookController::class,'read'])->name('readbook');
Route::post('/book/search', [BookController::class,'search'])->name('booksearch');
Route::post('/book/search-advance', [BookController::class,'searchAdvance'])->name('searchadvance');

Route::group(['prefix'=>'/admin'],function(){
    Route::get('/', [PagesController::class, 'index'])->name('admin.index');
    Route::resource('/books', BooksController::class);
    Route::resource('/authors', AuthorsController::class);
    Route::resource('/categories', CategoriesController::class);
    Route::resource('/publishers', PublishersController::class);
});

Route::group(['prefix'=>'/user'],function(){
    Route::get('/books', [UsersBookController::class, 'showMybooks'])->name('user.books');
    Route::get('/books/{category}', [UsersBookController::class, 'bookClassification'])->name('user.books.category');
    Route::get('/book/edit/{id}', [UsersBookController::class, 'editMyBook'])->name('user.book.edit');
    Route::post('/book/update/{id}', [UsersBookController::class, 'update'])->name('user.book.update');
    Route::post('/book/delete/{id}', [UsersBookController::class, 'delete'])->name('user.book.delete');
});

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categorybooks/{category_id}', [HomeController::class, 'bookClassification'])->name('categorybooks');