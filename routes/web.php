<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Mail\AdditionRequestedEmail;
use App\Mail\ContactAnsweredEmail;
use App\Mail\ContactCreatedClientEmail;
use App\Mail\ContactCreatedManagersEmail;
use App\Mail\CouponCreatedEmail;
use App\Mail\QuestionnaireEmail;
use App\Mail\ReservationCanceledEmail;
use App\Mail\ReservationConfirmedEmail;
use App\Mail\ReservationCreatedEmail;
use App\Mail\ScheduleActivityEmail;
use App\Models\Activity;
use App\Models\Addition;
use App\Models\User;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Hotel;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Models\Reservation;
use App\Models\Settings;

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

Route::get('e', function(){
    Artisan::call('questionnaires:email');
});

 
Route::middleware(['auth'])->group(function (){

    Route::view('home', 'admin.dashboard');
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

Route::get('m', function () {

/*     $reservation = Reservation::has('questionnaires')->first();
    $reservation->questionnaire = Questionnaire::first();
    Mail::to($reservation->client->email)->send(new QuestionnaireEmail($reservation)); */

 /*    $reservation = Reservation::first();
    $reservation->addition = Addition::first();
    Mail::to($reservation->client->email)->send(new AdditionRequestedEmail($reservation));  */

 /*    $contact = Contact::first();
    $contact->response = 'klnf pwenpwqrpwerm';
    Mail::to($contact->client->email)->send(new  ContactAnsweredEmail($contact));
  */

/*   $contact = Contact::first();
  Mail::to($contact->client->email)->send(new ContactCreatedManagersEmail($contact));
 */

/*  $email = Client::first()->email;
 $coupon = Coupon::first();
 Mail::to($email)->send(new CouponCreatedEmail($coupon));
 */

/*  $client = Client::first();
 Mail::to($client->email)->send(new ContactCreatedClientEmail(Contact::first()));
 */

 
/* $reservation = Reservation::first();
Mail::to($reservation->client->email)->send(new ReservationCanceledEmail($reservation));
 */

/*  $reservation = Reservation::first();
 Mail::to($reservation->client->email)->send(new ReservationConfirmedEmail($reservation));
 */
/* 
 $reservation = Reservation::first();
 Mail::to($reservation->client->email)->send(new ReservationCreatedEmail($reservation));
 */


/*  $email = Settings::pluck('email');
 $act = Activity::first();
 $act->hotel = Hotel::first();
 Mail::to($email)->send(new ScheduleActivityEmail($act)); */
});