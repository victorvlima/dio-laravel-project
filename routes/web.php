<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    //return 'Implementar VIEW index';
});

Route::get('/users', [UsersController::class, 'getUsers']);

Route::get('/user/{id}', [UsersController::class, 'getUserById']);

Route::get('/new-user', [UsersController::class, 'userForm'])->name('user.saved');

Route::post('/save-user', [UsersController::class, 'newUser']);

Route::put('/upd-user/{id}', [UsersController::class, 'updateUser'])->name('user.updated');

Route::put('/del-user/{id}', [UsersController::class, 'deleteUser']);

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user-logged', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
