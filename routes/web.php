<?php

use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
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
// Auth::loginUsingId(1);
// Auth::logout();
Route::get('/home', [DashboardController::class, 'index']);

Route::middleware('auth')->group(function(){    
   
    Route::controller(UserController::class)->prefix('/users')->group(function(){
        Route::get('/', 'index')->middleware('permission:users.get');
        Route::post('/', 'store')->middleware('permission:users.create');
        Route::get('/', 'update')->middleware('permission:users.edit');
        Route::get('/{email?}', 'show')->middleware('permission:users.get');  

    });


    Route::controller(ClientController::class)->prefix('/clients')->group(function(){
        Route::get('/', 'index')->middleware('permission:clients.get');
        Route::post('/', 'store')->middleware('permission:clients.add');
        Route::get('/up' , 'update')->middleware('permission:clients.edit');
        Route::get('/{email}', 'show')->middleware('permission:clients.get');
    });
});