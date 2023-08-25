<?php

use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HotelController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;

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


Route::get('/home', [DashboardController::class, 'index']);

Route::middleware('auth')->group(function(){ 
    
    Route::controller(UserController::class)->prefix('/users')->group(function(){
        Route::get('/', 'index')->middleware('permission:users.get')->name('users');
        Route::post('/', 'store')->middleware('permission:users.create')->name('users.create');
        Route::put('/', 'update')->middleware('permission:users.edit')->name('users.edit');
        Route::get('/get/{id}', 'get')->middleware('permission:users.get')->name('user.get.by.id');
        Route::get('/{email?}', 'show')->middleware('permission:users.get')->name('users.show');
        Route::delete('/{id}', 'destroy')->middleware('permission:users.delete')->name('users.delete');
    
    });

    Route::controller(ClientController::class)->prefix('/clients')->group(function(){
        Route::get('/', 'index')->middleware('permission:clients.get');
        Route::post('/', 'store')->middleware('permission:clients.create');
        Route::put('/' , 'update')->middleware('permission:clients.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:clients.delete');
        Route::get('/get/{id}', 'get')->middleware('permission:clients.get');
        Route::get('/{email}', 'show')->middleware('permission:clients.get');
    });


    Route::controller(HotelController::class)->prefix('/hotels')->group(function(){
        Route::get('/', 'index')->middleware('permission:hotels.get');
        Route::post('/', 'store')->middleware('permission:hotels.create');
        Route::post('/update', 'update')->middleware('permission:hotels.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:hotels.delete');
        Route::get('/{slug}', 'show')->middleware('permission:hotels.get');
    });
});