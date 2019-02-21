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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ProductsController@index');
Route::post('/products/store', 'ProductsController@store');
Route::get('/products/create', "ProductsController@create");
Route::get('/products/{product}', 'ProductsController@show');

Route::post('/products/{id}', 'OrdersController@order')->middleware('auth');

Route::get('/{category}', 'CategoryController@index');


Route::prefix('admin')->group(function () {

    Route::get('/', [
        'uses' => 'cms\HomePageController@index',
    ]);

    Route::get('/home', [
        'uses' => 'cms\HomePageController@index',
    ]);

    Route::get('/categories', [
        'uses' => 'cms\CategoryController@index',
    ]);
    Route::get('/categories/show/{id}', [
        'uses' => 'cms\CategoryController@show',
    ]);
    Route::get('/categories/create', [
        'uses' => 'cms\CategoryController@create',
    ]);

    Route::post('/categories/create', [
        'uses' => 'cms\CategoryController@store',
    ]);
    Route::patch('/categories/{id}', [
        'uses' => 'cms\CategoryController@update',
    ]);
    Route::delete('/categories/{id}/delete', [
        'uses' => 'cms\CategoryController@delete',
    ]);

    Route::get('/products', [
        'uses' => 'cms\ProductsController@index',
    ]);
    Route::get('/products/create', [
        'uses' => 'cms\ProductsController@create',
    ]);
    Route::get('/products/update/{id}', [
        'uses' => 'cms\ProductsController@show',
    ]);

    Route::post('/products/create', [
        'uses' => 'cms\ProductsController@store',
    ]);
    Route::post('/products/update/{id}', [
        'uses' => 'cms\ProductsController@update',
    ]);
    Route::delete('product/delete/{id}', [
        'uses' => 'cms\ProductsController@delete',
    ]);

    Route::get('/users', [
        'uses' => 'cms\UsersController@index',
    ]);

    Route::get('/users/create', [
        'uses' => 'cms\UsersController@create',
    ]);

    Route::get('/users/{id}', [
        'uses' => 'cms\UsersController@show',
    ]);

    Route::post('/users/create', [
        'uses' => 'cms\UsersController@store',
    ]);

    Route::post('/users/update/{id}', [
        'uses' => 'cms\UsersController@update',
    ]);

    Route::get('/orders', [
        'uses' => 'OrdersController@index',
    ]);

    Route::post('/orders/{id}/update', [
        'uses' => 'OrdersController@update'
    ]);


    Route::get('/login', [
        'uses' => 'cms\UsersController@login',
    ]);

    Route::post('/logout', [
        'uses' => 'cms\UsersController@logOut',
    ]);
    Route::post('/login', [
        'uses' => 'cms\UsersController@verification',
    ]);


});