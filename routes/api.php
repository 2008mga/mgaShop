<?php

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/products/{product}/commenting', 'ProductsController@commenting');
    Route::post('/bag/add', 'AuthController@addingToBag');
});

Route::post('auth', 'AuthController@login');

Route::middleware('auth:api')->get('/user', 'AuthController@me');

Route::get('/categories', 'CategoryController@all')->name('api.categories');
Route::get('/categories/popular', 'CategoryController@popular')->name('api.categories.popular');
Route::get('/categories/{category}', 'CategoryController@get')->name('api.categories.get');

Route::get('/products', 'ProductsController@index')->name('api.products');
Route::get('/products/{product}', 'ProductsController@get')->name('api.products.get');
