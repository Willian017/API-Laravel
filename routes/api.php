<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::apiResource('/produtos', ProdutoController::class);

Route::get('/produtos', [ProdutoController::class, "index"]);

Route::get('/produtos/{id}', [ProdutoController::class, "show"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/produtos', [ProdutoController::class, 'store']);
});

Route::put('/produtos/{id}', [ProdutoController::class, "update"]);

Route::delete('/produtos/{id}', [ProdutoController::class, "destroy"]);

Route::post('/registro', [AuthController::class, "registro"]);

Route::post('/login', [AuthController::class, "login"])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
