<?php
$namespace = 'Modules\Dashboard\Controllers';

use Illuminate\Support\Facades\Route;


Route::middleware('App\Http\Middleware\check_api')->prefix('api')->group(function () {
    Route::any('/list-users', 'Modules\Dashboard\Controllers\DashboardController@get_list_user');
    Route::post('/add-group', 'Modules\Dashboard\Controllers\DashboardController@add_group_user');
    Route::post('/add-user', 'Modules\Dashboard\Controllers\DashboardController@add_user');
    Route::any('/add-product', 'Modules\Dashboard\Controllers\DashboardController@add_product');
    Route::post('/list-product', 'Modules\Dashboard\Controllers\DashboardController@get_list_prod');
    Route::get('/get-product/{id}/{type}', 'Modules\Dashboard\Controllers\DashboardController@get_product');

});

Route::middleware('check_admin')->prefix('admin')->group(function () {
    Route::any("/{controller}/{action}", 'Modules\Dashboard\Controllers\DashboardController@handle');
    Route::any('/{controller}','Modules\Dashboard\Controllers\DashboardController@handle');
    Route::any('/','Modules\Dashboard\Controllers\DashboardController@handle');
});
