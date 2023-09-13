<?php

use App\Http\Controllers\Web\CardController;
use App\Http\Controllers\Web\ClientController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\CountryController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HotelController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\UserController;
use App\Models\User;
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
    return view('auth.login');
});
//   Auth::logout();
 Auth::loginUsingId(1);

Route::view('forgot-password', 'auth.forgot-password')->name('password.request'); 
//1-  vista donde se pone el correo
Route::post('password-recover-email', [UserController::class, 'recover_email'])->name('forgot.password.email'); 
//2- manda el correo
Route::view('password-recover/{token}/{email}', 'auth.recover-password')->name('recover.password'); 
// 3-  vista donde se reinicia la contraseña
Route::post('password-update', [UserController::class, 'password_update'])->name('password.update'); 
// 4- actualiza la contraseña 


Route::middleware('auth')->group(function(){

    Route::get('/home', [DashboardController::class, 'index'])->name('home'); 
    
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

    Route::controller(CountryController::class)->prefix('/countries')->group(function(){
        Route::get('/', 'index')->middleware('permission:countries.get')->name('countries');
        Route::post('/', 'store')->middleware('permission:countries.create')->name('countries.store');
        Route::put('/', 'update')->middleware('permission:countries.edit')->name('countries.update');  
        Route::delete('/{id}', 'destroy')->middleware('permission:countries.delete')->name('countries.delete');
        Route::get('/get/{id}', 'get')->middleware('permission:countries.get')->name('countries.get.by.id');
        Route::get('/{id}', 'show')->middleware('permission:countries.get')->name('countries.get');
    });

    Route::controller(CardController::class)->prefix('/cards')->group(function(){
        Route::get('/', 'index')->middleware('permission:cards.get')->name('cards');
        Route::post('/', 'store')->middleware('permission:cards.create')->name('cards.create');
        Route::put('/', 'update')->middleware('permission:cards.edit')->name('cards.update');
        Route::delete('/{id}', 'destroy')->middleware('permission:cards.delete')->name('cards.delete');
    });

    //usuarios 
    Route::controller(UserController::class)->prefix('/users')->group(function(){
        Route::post('/update-avatar', 'update_avatar')->permission('users.edit')->name('users.update.avatar');

        Route::get('/', 'index')->middleware('permission:users.get')->name('users');
        Route::post('/', 'store')->middleware('permission:users.create')->name('users.create');
        Route::put('/', 'update')->middleware('permission:users.edit')->name('users.edit');
        Route::get('/get/{id}', 'get')->middleware('permission:users.get')->name('users.get.by.id');
        Route::get('/{id}', 'show')->middleware('permission:users.get')->name('users.show');
        Route::delete('/{id}', 'destroy')->middleware('permission:users.delete')->name('users.delete');
    
    });

    //roles 
    Route::controller(RoleController::class)->prefix('/roles')->group(function(){
        Route::get('/', 'index')->middleware('permission:roles.get')->name('roles');
        Route::post('/', 'store')->middleware('permission:roles.create')->name('roles.store');
        Route::put('/', 'update')->middleware('permission:roles.edit')->name('roles.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:roles.delete')->name('roles.delete');
        Route::get('get/{id}', 'get')->middleware('permission:roles.get')->name('roles.get.by.id');
        Route::get('/{id}', 'show')->middleware('permission:roles.get')->name('roles.get');
    }); 

    //clientes 
    Route::controller(ClientController::class)->prefix('/clients')->group(function(){
        Route::get('/', 'index')->middleware('permission:clients.get')->name('clients');
        Route::post('/', 'store')->middleware('permission:clients.create')->name('clients.create');
        Route::put('/' , 'update')->middleware('permission:clients.edit')->name('clients.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:clients.delete')->name('clients.delete');
        Route::get('/get/{id}', 'get')->middleware('permission:clients.get')->name('clients.get.by.id');
        Route::get('/{email}', 'show')->middleware('permission:clients.get')->name('clients.show');
    });

    //contactos 
    Route::controller(ContactController::class)->prefix('/contacts')->group(function(){
        Route::get('/', 'index')->middleware('permission:contacts.get')->name('contacts');
        Route::post('/', 'store')->middleware('permission:contacts.create')->name('contacts.create');
        Route::put('/', 'update')->middleware('permission:contacts.edit')->name('contacts.edit');
        Route::delete('/{id}', 'destroy')->middleware('permission:contacts.delete')->name('contacts.delete');
        Route::get('/get/{id}', 'get')->middleware('permission:contacts.get')->name('contacts.get.by.id');
        Route::get('/{id}', 'show')->middleware('permission:contacts.get')->name('contacts.show');
    });

    //configuraciones
    Route::controller(SettingController::class)->prefix('/settings')->group(function(){
        Route::get('/', 'index')->middleware('permission:settings.get')->name('settings');
        Route::get('/get/{id}', 'get')->middleware('permission:settings.get')->name('settings.get.by.id');
        Route::post('/', 'update')->middleware('permission:settings.edit')->name('settings.update');
    });
});