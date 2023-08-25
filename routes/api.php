<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\HotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

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

Route::middleware(['auth:sanctum'])->group(function(){ 
    
/*     Route::controller(UserController::class)->prefix('/users')->group(function () {
        Route::delete('/{id}','destroy')->middleware('permission:users.delete');
    });
 */
 
/*     Route::controller(ClientController::class)->prefix('/clients')->group(function(){
        Route::get('/{email}', 'get')->middleware('permission:clients.get');
        Route::delete('/{id}', 'destroy')->middleware('permission:clients.delete');
    }); */

    Route::controller(HotelController::class)->prefix('/hotels')->group(function(){
        Route::get('/{slug}', 'get')->middleware('permission:hotels.get');
    });
});

env('APP_DEBUG') && Route::post('/test', function(Request $request){
    Auth::loginUsingId(1);
    $res = (new App\Http\Controllers\Web\UserController)->destroy(1 );
   
 
    // return $res; 
    
    return [
        'res' => $res,
        'status' => session('errors'),
     
    ];
});