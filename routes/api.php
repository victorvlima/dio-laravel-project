<?php

use App\Http\Controllers\Api\UsersApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Grupo de rotas da API de usuários
Route::prefix('users')->group(function () {
    // GET /api/users - Lista todos os usuários
    Route::get('/', [UsersApiController::class, 'index']);
    
    // GET /api/users/{id} - Busca usuário por ID
    Route::get('/{id}', [UsersApiController::class, 'show']);
    
    // POST /api/users - Cria novo usuário
    Route::post('/', [UsersApiController::class, 'store']);
    
    // PUT /api/users/{id} - Atualiza usuário
    Route::put('/{id}', [UsersApiController::class, 'update']);
    
    // DELETE /api/users/{id} - Deleta usuário
    Route::delete('/{id}', [UsersApiController::class, 'destroy']);
});

// Ou usando Resource Route (mais conciso):
// Route::apiResource('users', UsersApiController::class);