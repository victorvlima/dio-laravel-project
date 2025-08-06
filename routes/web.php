<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    //return 'Implementar VIEW index';
});

// Lista todos os usuários
Route::get('/users', [UsersController::class, 'getUsers'])->name('users.index');

// Busca o usuário pelo seu ID
Route::get('/users/{id}', [UsersController::class, 'getUserById'])->name('users.show');

// Exibe o formulário para registro de um novo usuário
Route::get('/new-user', [UsersController::class, 'userForm'])->name('users.create');

// Processa o registro de um novo usuário
Route::post('/save-user', [UsersController::class, 'newUser'])->name('users.store');

// Mostrar formulário de edição
Route::get('/users/{id}/edit', [UsersController::class, 'editUser'])->name('users.edit');

// Processar atualização
Route::put('/users/{id}', [UsersController::class, 'updateUser'])->name('users.update');

// Deleta o usuário selecionado
Route::delete('/users/{id}', [UsersController::class, 'deleteUser'])->name('users.destroy');

