<?php

use App\Models\Client;

Route::post('/auth/register', 'Api\Auth\RegisterController@store');
Route::post('/auth/token', 'Api\Auth\AuthClientController@auth');


Route::group([
    'namespace' => 'Api',
    'middleware' => ['auth:sanctum']
], function(){
    Route::get('/auth/me', 'Auth\AuthClientController@me');
    Route::post('/auth/logout', 'Auth\AuthClientController@logout');

    Route::post('/auth/v1/orders/{identifyOrder}/evaluations', 'evaluationApiController@store');    
    Route::get('/auth/v1/my-orders', 'OrderApiController@myOrders');
    Route::post('/auth/v1/orders', 'OrderApiController@store');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function (){
    Route::get('/tenants/{uuid}', 'TenantApiController@show');
    Route::get('/tenants', 'TenantApiController@index');

    Route::get('/categories/{identify}', 'CategoryApiController@show');
    Route::get('/categories', 'CategoryApiController@categoriesByTenant');

    Route::get('/tables/{identify}', 'TableApiController@Show');
    Route::get('/tables', 'TableApiController@tablesByTenant');

    Route::get('/products/{identify}', 'ProductApiController@show');
    Route::get('/products', 'ProductApiController@productsByTenant');

    Route::post('/auth/register', 'Auth\RegisterController@store');

    Route::post('/orders', 'OrderApiController@store');
    Route::get('/orders/{identify}', 'OrderApiController@show');
});