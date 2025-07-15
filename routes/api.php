<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContactMessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn(Request $request) => $request->user());

    
    // Biens immobiliers protégés
    Route::apiResource('properties', PropertyController::class)->except(['index', 'show']);
});


/*
|--------------------------------------------------------------------------
| Routes API publiques (sans middleware)
|--------------------------------------------------------------------------
*/

// Biens immobiliers
///Route::apiResource('properties', PropertyController::class);

// Routes publiques pour consulter les biens
Route::get('properties', [PropertyController::class, 'index']);
Route::get('properties/{property}', [PropertyController::class, 'show']);


// Visites
Route::apiResource('visits', VisitController::class);

// Contrats
Route::apiResource('contracts', ContractController::class);

// Images (avec upload)
Route::apiResource('images', ImageController::class);

// Messages de contact
Route::apiResource('messages', ContactMessageController::class);