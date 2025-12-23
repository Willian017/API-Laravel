<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
use App\Execeptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::apiResource('/produtos', ProdutoController::class);

Route::group(['prefix' => '/produtos'], function() {
    Route::get('', [ProdutoController::class, 'index']);
    Route::get('/{id}', [ProdutoController::class, 'show']);
    Route::middleware('auth:sanctum')->post('', [ProdutoController::class, 'store']);
    Route::middleware('auth:sanctum')->put('/{id}', [ProdutoController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('/{id}', [ProdutoController::class, 'destroy']);
});

Route::post('/registro', [AuthController::class, 'registro']);

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
