<?php

use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\api\ReservationController;
use App\Http\Controllers\ReservationController as ControllersReservationController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('rooms/{id}', [RoomController::class, 'get']);
    Route::delete('rooms/{id}', [RoomController::class, 'destroy']);
    
    Route::get('hotels/{slug}', [HotelController::class, 'get']);
    Route::delete('hotels/{slug}', [HotelController::class, 'destroy']);
    
    // comentarios y precios de l dia del hotel
    Route::get('hotels/comments/rates', [HotelController::class, 'get_comments_and_rates']);
    Route::get('hotels/comments', [HotelController::class, 'get_comments']);

    Route::get('reservations/{id}', [ReservationController::class, 'get']);
    Route::get('reservation_status/{id}/{status}', [ReservationController::class, 'change_status_reservation']);

    Route::get('reservations-card/{id}', [ReservationController::class, 'get_card']);
    Route::get('reservations-code/{code}', [ReservationController::class, 'getReservationCode']);
    Route::get('cards/encrypt', [ControllersReservationController::class, 'encrypt_cards']);

// });