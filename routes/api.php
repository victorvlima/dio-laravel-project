<?php

use App\Http\Controllers\HelloWorldController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/hello/{nome}', [HelloWorldController::class, 'hello']);

Route::get('/user', function (Request $request) {
    return "Implementar /user";
//    return $request->user();
});

Route::post('/post', function () {
    echo "POST aqui!";
});

Route::get('/user-logged', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

