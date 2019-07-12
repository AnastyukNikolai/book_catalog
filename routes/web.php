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

Route::get('/', 'BookController@index')->name('showAllBooks');

Route::get('/show/book/{id}', 'BookController@show')->name('showBook');

////////////////////////////////////

Route::get('/authors', 'AuthorController@index')->name('showAllAuthors');

Route::get('/show/author/{id}', 'AuthorController@show')->name('showAuthor');

////////////////////////////////////

Route::get('/rubrics', 'RubricController@index')->name('showAllRubrics');

Route::get('/show/rubric/{id}', 'RubricController@show')->name('showRubric');



Route::get('/add/book', 'BookController@add')->name('addBook');

Route::post('/store/book', 'BookController@store')->name('storeBook');

Route::get('/edit/book/{id}', 'BookController@edit')->name('editBook');

Route::post('/update/book', 'BookController@update')->name('updateBook');

Route::get('/delete/book/{id}', 'BookController@delete')->name('deleteBook');

////////////////////////////////////

Route::post('/store/author', 'AuthorController@store')->name('storeAuthor');

Route::post('/update/author/{id}', 'AuthorController@update')->name('updateAuthor');

Route::get('/delete/author/{id}', 'AuthorController@delete')->name('deleteAuthor');

////////////////////////////////////

Route::post('/store/rubric', 'RubricController@store')->name('storeRubric');

Route::post('/update/rubric/{id}', 'RubricController@update')->name('updateRubric');

Route::get('/delete/rubric/{id}', 'RubricController@delete')->name('deleteRubric');

////////////////////////////////////

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
