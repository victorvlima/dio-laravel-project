<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    //return 'Implementar VIEW index';
});

Route::get('/users', [UsersController::class, 'getUsers'])->name('users.index');

Route::get('/users/{id}', [UsersController::class, 'getUserById'])->name('users.show');

Route::get('/new-user', [UsersController::class, 'userForm'])->name('users.create');

Route::post('/save-user', [UsersController::class, 'newUser'])->name('users.store');

Route::put('/upd-user/{id}', [UsersController::class, 'updateUser'])->name('users.edit');

Route::put('/del-user/{id}', [UsersController::class, 'deleteUser'])->name('users.destroy');

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user-logged', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
