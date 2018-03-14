<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

/**
 * Categories
 */


//Route::get('category', 'CategoryController@index')->name('category.index');
//Route::get('category/create', 'CategoryController@create')->name('category.create');
Route::resource('category', 'CategoryController');
Route::resource('post', 'PostController');
//Route::get('category', [
//    'as' => 'category.index',
//    'uses' => 'CategoryController'
//]);
