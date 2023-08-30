<?php

use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HotelController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Whoops\Run;

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
// Auth::logout();
// Auth::loginUsingId(1);
Route::get('/home', [DashboardController::class, 'index']);

Route::middleware('auth')->group(function(){ 
    
    Route::controller(UserController::class)->prefix('/users')->group(function(){
        Route::get('/', 'index')->middleware('permission:users.get')->name('users');
        Route::post('/', 'store')->middleware('permission:users.create')->name('users.create');
        Route::put('/', 'update')->middleware('permission:users.edit')->name('users.edit');
        Route::get('/get/{id}', 'get')->middleware('permission:users.get')->name('user.get.by.id');
        Route::get('/{id}', 'show')->middleware('permission:users.get')->name('users.show');
        Route::delete('/{id}', 'destroy')->middleware('permission:users.delete')->name('users.delete');
    
    });

    Route::controller(ClientController::class)->prefix('/clients')->group(function(){
        Route::get('/', 'index')->middleware('permission:clients.get')->name('clients');
        Route::post('/', 'store')->middleware('permission:clients.create')->name('clients.create');
        Route::put('/' , 'update')->middleware('permission:clients.edit')->name('clients.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:clients.delete')->name('clients.delete');
        Route::get('/get/{id}', 'get')->middleware('permission:clients.get')->name('clients.get');
        Route::get('/{email}', 'show')->middleware('permission:clients.get')->name('clients.show');
    });


    Route::controller(HotelController::class)->prefix('/hotels')->group(function(){
        Route::get('/', 'index')->middleware('permission:hotels.get')->name('hotels');
        Route::post('/', 'store')->middleware('permission:hotels.create')->name('hotels.create');
        Route::post('/update', 'update')->middleware('permission:hotels.edit')->name('hotels.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:hotels.delete')->name('hotels.delete');
        Route::get('/get/{id}', 'get')->middleware('permission:users.get')->name('hotels.get.by.id');
        Route::get('/{id}', 'show')->middleware('permission:hotels.get')->name('hotels.show');
    });

    Route::controller(RoomController::class)->prefix('/rooms')->group(function(){
        Route::get('/', 'index')->middleware('permission:rooms.get')->name('rooms');
        Route::post('/', 'store')->middleware('permission:rooms.create')->name('rooms.create');
        Route::post('/update', 'update')->middleware('permission:rooms.edit')->name('rooms.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:rooms.delete')->name('rooms.delete');
        Route::get('/get/{id}', 'get')->middleware('permission:rooms.get')->name('rooms.get.by.id');
        Route::get('/{id}', 'show')->middleware('permission:rooms.get')->name('rooms.get');
    });

    Route::controller(RoleController::class)->prefix('/roles')->group(function(){
        Route::get('/', 'index')->middleware('permission:roles.get')->name('roles');
        Route::post('/', 'store')->middleware('permission:roles.create')->name('roles.store');
        Route::put('/', 'update')->middleware('permission:roles.edit')->name('roles.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:roles.delete')->name('roles.delete');
        Route::get('get/{id}', 'get')->middleware('permission:roles.get')->name('roles.get.by.id');
        Route::get('/{id}', 'show')->middleware('permission:roles.get')->name('roles.get');
    });

    Route::controller(SettingController::class)->prefix('/settings')->group(function(){
        Route::get('/', 'index')->middleware('permission:settings.get')->name('settings');
        Route::get('/get/{id}', 'get')->middleware('permission:settings.get')->name('settings.get');
        Route::post('/', 'update')->middleware('permission:settings.edit')->name('settings.update');
    });
});