<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/produtos', [ProdutoController::class, "index"]);

Route::get('/produtos/{id}', [ProdutoController::class, "show"]);

Route::get('/produtos', [ProdutoController::class, "filter"]);

Route::post('/produtos', [ProdutoController::class, "store"]);

Route::put('/produtos/{id}', [ProdutoController::class, "update"]);

Route::delete('/produtos/{id}', [ProdutoController::class, "destroy"]);
