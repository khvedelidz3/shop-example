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

Route::prefix('admin')->group(function () {

    Route::get('/', [
        'uses' => 'cms\HomePageController@index',
        'middleware' => ['role:admin']
    ]);

    Route::get('/categories', [
        'uses' => 'cms\CategoryController@index',
        'middleware' => ['role:admin']
    ]);
    Route::get('/categories/show/{id}', [
        'uses' => 'cms\CategoryController@show',
        'middleware' => ['role:admin']
    ]);
    Route::get('/categories/create', [
        'uses' => 'cms\CategoryController@create',
        'middleware' => ['role:admin']
    ]);

    Route::post('/categories/create', [
        'uses' => 'cms\CategoryController@store',
        'middleware' => ['role:admin']
    ]);
    Route::patch('/categories/{id}', [
        'uses' => 'cms\CategoryController@update',
        'middleware' => ['role:admin']
    ]);
    Route::delete('/categories/{id}/delete', [
        'uses' => 'cms\CategoryController@delete',
        'middleware' => ['role:admin']
    ]);

    Route::get('/products', [
        'uses' => 'cms\ProductsController@index',
        'middleware' => ['role:admin']
    ]);
    Route::get('/products/create', [
        'uses' => 'cms\ProductsController@create',
        'middleware' => ['role:admin']
    ]);
    Route::get('/products/update/{id}', [
        'uses' => 'cms\ProductsController@show',
        'middleware' => ['role:admin']
    ]);

    Route::post('/products/create', [
        'uses' => 'cms\ProductsController@store',
        'middleware' => ['role:admin']
    ]);
    Route::post('/products/update/{id}', [
        'uses' => 'cms\ProductsController@update',
        'middleware' => ['role:admin']
    ]);
    Route::delete('/product/delete/{id}', [
        'uses' => 'cms\ProductsController@delete',
        'middleware' => ['role:admin']
    ]);

    Route::get('/users', [
        'uses' => 'cms\UsersController@index',
        'middleware' => ['role:admin']
    ]);

    Route::get('/users/create', [
        'uses' => 'cms\UsersController@create',
        'middleware' => ['role:admin']
    ]);

    Route::get('/users/{id}', [
        'uses' => 'cms\UsersController@show',
        'middleware' => ['role:admin']
    ]);

    Route::post('/users/create', [
        'uses' => 'cms\UsersController@store',
        'middleware' => ['role:admin']
    ]);

    Route::post('/users/update/{id}', [
        'uses' => 'cms\UsersController@update',
        'middleware' => ['role:admin']
    ]);

    Route::get('/orders', [
        'uses' => 'OrdersController@index',
        'middleware' => ['role:admin']
    ]);

    Route::post('/orders/{id}/update', [
        'uses' => 'OrdersController@update',
        'middleware' => ['role:admin']
    ]);


    Route::get('/login', [
        'uses' => 'cms\UsersController@login',
    ]);

    Route::post('/logout', [
        'uses' => 'cms\UsersController@logOut',
        'middleware' => ['role:admin']
    ]);
    Route::post('/login', [
        'uses' => 'cms\UsersController@verification',
    ]);


});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ProductsController@index');
Route::post('/products/store', 'ProductsController@store');
Route::get('/products/create', "ProductsController@create");
Route::get('/products/{product}', 'ProductsController@show');

Route::post('/products/{id}', 'OrdersController@order')->middleware('auth');

Route::get('/{category}', 'CategoryController@index');


