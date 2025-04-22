<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/films', function () {
    return view('films.film');
});

Route::get('/reservation', function () {
    return view('reservations.reservation');
});

Route::get('/seances/create', function () {
    return view('seances.create');
});
Route::get('/seances', [SeanceController::class, 'index']);
Route::post('/seances', [SeanceController::class, 'store']);
