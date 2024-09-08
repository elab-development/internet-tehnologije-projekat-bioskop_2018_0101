<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\FilmController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ProjekcijaController;

// Javni GET zahtevi (nezaštićeni)
Route::get('/films', [FilmController::class, 'index']);
Route::get('/films/{id}', [FilmController::class, 'show']);
Route::get('/films/export', [FilmController::class, 'exportCsv']);
Route::apiResource('projekcije', ProjekcijaController::class)->only(['index', 'show']);
Route::apiResource('sale', SalaController::class)->only(['index', 'show']);

// Zaštićeni POST, PUT, DELETE zahtevi (samo za autentifikovane korisnike)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('projekcije', ProjekcijaController::class)->except(['index', 'show']);
    Route::apiResource('sale', SalaController::class)->except(['index', 'show']);
    
    Route::post('/films', [FilmController::class, 'store']);
    Route::put('/films/{id}', [FilmController::class, 'update']);
    Route::delete('/films/{id}', [FilmController::class, 'destroy']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Javni POST zahtevi za registraciju i prijavu (nezaštićeni)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
