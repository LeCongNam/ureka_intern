<?php
$namespace = 'Modules\Auth\Controllers';

use Illuminate\Support\Facades\Route;


Route::prefix('api')->group(function () {
     Route::any('/login', 'Modules\Auth\Controllers\AuthController@login');
     Route::post('/register',  'Modules\Auth\Controllers\AuthController@register');
     Route::get('/logout',  'Modules\Auth\Controllers\AuthController@logout');
});

Route::prefix('auth')->group(function () {
    Route::any('/','Modules\Auth\Controllers\AuthController@handle');
    Route::any("/{controller}/{action}", 'Modules\Auth\Controllers\AuthController@handle');
    Route::any('/{controller}','Modules\Auth\Controllers\AuthController@handle');
});
