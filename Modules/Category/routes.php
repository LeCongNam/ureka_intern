<?php
$namespace = 'Modules\Category\Controllers';

use Illuminate\Support\Facades\Route;



Route::prefix('api')->middleware('App\Http\Middleware\auth_user')->group(function () {
    Route::any('/details', 'Modules\Category\Controllers\CategoryController@details');
});

Route::middleware('App\Http\Middleware\auth_user')->prefix('category')->group(function () {
    Route::get("/{controller}/{action?}",  'Modules\Category\Controllers\CategoryController@index');
    Route::get('/{controller?}', 'Modules\Category\Controllers\CategoryController@index');
    Route::get('/', 'Modules\Category\Controllers\CategoryController@index');
});
// middleware('App\Http\Middleware\auth_user')

