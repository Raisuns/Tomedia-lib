<?php

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
    return redirect()->route('login');
});

Route::get('/profile', 'ProfileController@edit')->name('profile.edit')->middleware('auth');
Route::put('/profile', 'ProfileController@update')->name('profile.update')->middleware('auth');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard.index');

    // Data Master
    Route::resource('/users', 'Admin\UserController');
    Route::resource('/book-types', 'Admin\BookTypeController');
    Route::resource('/books', 'Admin\BookController');
    Route::resource('/book-borrowers', 'Admin\BookUserController');
    Route::resource('/book-borrowers-history', 'Admin\BookBorrowerHistoryController');

    // Detail book on JSON
    Route::get('/book-json/{id}', 'Admin\JsonResponseController@detailBook')->name('json-book.show');

    // Detail user on JSON
    Route::get('/user-json/{id}', 'Admin\JsonResponseController@detailUser')->name('json-user.show');

    // Book borrower approved button
    Route::put('/book-approved/{id}', 'Admin\JsonResponseController@approvedBookBorrower')->name('json-book.approved');

    // Book borrower not approve button
    Route::put('/book-not-approved/{id}', 'Admin\JsonResponseController@notApproveBookBorrower')->name('json-book.not-approved');

    // Book borrower return button
    Route::put('/book-return/{id}', 'Admin\JsonResponseController@returnBookBorrower')->name('json-book.return');
});

Route::group(['prefix' => 'anggota', 'as' => 'anggota.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', 'Anggota\DashboardController@index')->name('dashboard.index');

    // Menu
    Route::resource('/book-borrowers-history', 'Anggota\BookBorrowerHistoryController');

    // Store JSON
    Route::post('/book-borrowers-json', 'Anggota\JsonResponseController@store')->name('json-book-borrowers.store');

    Route::resource('/book-borrow', 'Anggota\BookBorrowController');

    // Katalog Buku
    Route::get('/books', 'Anggota\BookController@index')->name('books.index');
    Route::get('/books/{id}', 'Anggota\BookController@show')->name('books.show');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
