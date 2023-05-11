<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('e', function(){
    Artisan::call('questionnaires:email');
});

 
Route::middleware(['auth'])->group(function (){

    Route::view('home', 'auth.home');
    // rutas rooms
    Route::get('rooms', [RoomController::class, 'index'])->middleware('permission:rooms.get');
    Route::get('rooms/{room_slug}/{hotel_slug}', [RoomController::class, 'show'])->middleware('permission:rooms.get');
    Route::post('rooms', [RoomController::class, 'store'])->middleware('permission:rooms.add');
    Route::put('rooms', [RoomController::class, 'update'])->middleware('permission:rooms.edit');
    Route::put('type/max_people/update', [RoomController::class, 'update_max_people'])->middleware('permission:rooms.edit');

    // rutas hotels
    Route::get('hotels', [HotelController::class, 'index']);
    Route::post('hotels', [HotelController::class, 'store']);
    Route::get('hotels/{slug}', [HotelController::class, 'show']);
    Route::put('hotels', [HotelController::class, 'update']);

});