<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/user/{id}', [AuthController::class, 'getUsers']);

Route::post('/commande/creation', [CommandeController::class, 'store']);
Route::get('/mes_Commandes', [CommandeController::class, 'showMyCommandes'])->middleware('check.user');
Route::put('/commande/{id}/cancel', [CommandeController::class, 'update'])->middleware('check.user');
