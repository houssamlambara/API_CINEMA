<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SiegeController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReservationController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH
Route::middleware('auth:api')->group(function () {});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::put('/update', [AuthController::class, 'updateProfile']);
Route::post('/logout', [AuthController::class, 'logout']);

// FILM
Route::get('/films', [FilmController::class, 'index']);
Route::post('/films', [FilmController::class, 'register']);
Route::get('/films/{id}', [FilmController::class, 'show']);
Route::put('/films/{id}', [FilmController::class, 'update']);
Route::delete('/films/{id}', [FilmController::class, 'delete']);

// SEANCE
Route::get('/seances', [SeanceController::class, 'index']);
Route::get('/seances/{id}', [SeanceController::class, 'show']);
Route::get('/seances/{id}/sieges', [SeanceController::class, 'getSieges']);
Route::post('/seances', [SeanceController::class, 'register']);
Route::put('/seances/{id}', [SeanceController::class, 'update']);
Route::delete('/seances/{id}', [SeanceController::class, 'destroy']);

// RESERVATION
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus']);
});

// SIEGE
Route::middleware('auth:api')->group(function () {
    Route::get('/sieges', [SiegeController::class, 'index']);
    Route::get('/sieges/{id}', [SiegeController::class, 'show']);
    Route::post('/sieges', [SiegeController::class, 'store']);
    Route::put('/sieges/{id}', [SiegeController::class, 'update']);
    Route::delete('/sieges/{id}', [SiegeController::class, 'destroy']);
});

// SALLE
Route::get('/salles', [SalleController::class, 'index']);       
Route::post('/salles', [SalleController::class, 'store']);        
Route::get('/salles/{id}', [SalleController::class, 'show']);     
Route::put('salle/{id}', [SalleController::class, 'update']);     
Route::delete('/salles/{id}', [SalleController::class, 'destroy']);

// PAYMENT

Route::post('payment', [PaymentController::class, 'createPayment']);
Route::get('payment/{paymentId}', [PaymentController::class, 'getPaymentById']);
Route::get('payments/user/{userId}', [PaymentController::class, 'getPaymentsByUser']);

// TICKET 
Route::get('/generate-ticket/{paymentId}', [TicketController::class, 'generate']);

