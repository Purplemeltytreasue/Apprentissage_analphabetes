<?php

use App\Modules\User\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'middleware' => 'api',
    'prefix' => 'api/users'

], function ($router) {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'create']);


});

// verifie si le token est pris 
Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/users'

    // pour se deconnecter
], function ($router) {
    Route::post('/logout', [UserController::class, 'logout']);
});


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/users'

], function ($router) {
    Route::get('/', [UserController::class, 'index']);


});