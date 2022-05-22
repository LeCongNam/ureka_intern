<?php
$namespace = 'Modules\Dashboard\Controllers';

use Illuminate\Support\Facades\Route;


Route::middleware('App\Http\Middleware\check_api')->prefix('api')->group(function () {
    Route::post('/add-group', 'Modules\Dashboard\Controllers\DashboardController@add_group_user');
    Route::post('/add-user', 'Modules\Dashboard\Controllers\DashboardController@add_user');
    Route::get('/list-users/{page}/{total?}', 'Modules\Dashboard\Controllers\DashboardController@get_list_user');
    Route::get('/get-user/{id}', 'Modules\Dashboard\Controllers\DashboardController@get_single_user');
    Route::post('/edit-user', 'Modules\Dashboard\Controllers\DashboardController@edit_user');
    Route::delete('/delete-user/{id}', 'Modules\Dashboard\Controllers\DashboardController@delete_user');

    Route::any('/add-product', 'Modules\Dashboard\Controllers\DashboardController@add_product');
    Route::get('/list-product', 'Modules\Dashboard\Controllers\DashboardController@get_list_prod');
    Route::get('/get-product/{id}', 'Modules\Dashboard\Controllers\DashboardController@get_product');
    Route::post('/edit-product/{id}', 'Modules\Dashboard\Controllers\DashboardController@edit_product');
    Route::delete('/delete-product/{id}', 'Modules\Dashboard\Controllers\DashboardController@delete_product');
});


Route::middleware('check_admin')->prefix('admin')->group(function () {
    Route::get("/{controller}/{action}/{id}", 'Modules\Dashboard\Controllers\DashboardController@handle');
    Route::any("/{controller}/{action}/{option}", 'Modules\Dashboard\Controllers\DashboardController@handle');
    Route::any("/{controller}/{action}", 'Modules\Dashboard\Controllers\DashboardController@handle');
    Route::any('/{controller}','Modules\Dashboard\Controllers\DashboardController@handle');
    Route::any('/','Modules\Dashboard\Controllers\DashboardController@handle');
});
