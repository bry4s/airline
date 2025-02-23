<?php

use App\Http\Controllers\TripController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(UserController::class)->group(function() {
    Route::post('signup', 'signup');
    Route::post('signin', 'signin');
    Route::post('signout', 'signout');
});

Route::controller(TripController::class)->group(function() {
    Route::get('trips', 'index');
    Route::get('trip','show');
    Route::post('trip', 'store');
});

Route::controller(TicketController::class)->group(function() {
    Route::get('tickets', 'index');
    Route::get('ticket','show');
    Route::post('ticket', 'store');
});