<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ScheduleController;
use App\Mail\ReservationCanceledEmail;
use App\Mail\ReservationCreatedEmail;
use App\Models\Client;
use App\Models\FacturationData;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Hotel;
use App\Models\Schedule;
use App\Models\ReservationRoom;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    private $clave = 'ea1096223362a8f45fd1404j4b42ba7f';
    private $method = 'aes-256-cbc';
    private $iv = "R+r+/9YKBZ8rym03fb5Rbg==";


    public function get($id){
        $reservation = Reservation::where('id', $id)
            ->with('client', 'room', 'rate')->first();
    
        if($reservation){
            LogController::store(Auth::user()->id, 'Consultar', $reservation->id, 'Consultar reservaciones', 'reservations', '/reservations/'.$id);

            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 2,
                'data' => $reservation
            ], 200);
        }

        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -5,
            'data' => null
        ]);
    }

    // consultar si el codigo de reservacion está libre 
    public function getReservationCode($code){
        $exists = Reservation::where('code', $code)->exists();
        return response()->json([
            'message' => 'Informacion consultada correctamente',
            'code' => 2, 
            'data' => $exists
        ], 200);   
    }

    // cambiar el status de la reservación 
    public function change_status_reservation($id, $status){
        $reservation = Reservation::where('id', $id)
            ->with('facturacion_data')
            ->withCount('reservations_rooms')
            ->first();


        
            // error_log(json_encode($reservation->code));
        
            if(is_null($reservation->code) && $status != 'cancelada'){
            return response()->json([
                'message' => 'Error. La reservacion no tiene codigo',
                'code' => -2,
                'data' => null
            ], 406);
         }


         if($reservation){


            $reservation->status = $status;

            if($reservation->save()){
                // carga informacion de la reservacion

                $reservation->loadMissing('room', 'rate', 'client');
                $reservation->room->load(['hotel']);
                $reservation->room->load(['type']);

                if($reservation->status == 'cancelada'){
                    // regresar stock 
                    ScheduleController::regresarStock($reservation);

                    Mail::to($reservation->client->email)->send(new ReservationCanceledEmail($reservation));

                    return response()->json([
                        'message' => 'Registro actualizado correctamente',
                        'code' => -2,
                        'data' => $reservation
                    ], 200);
                
                }

                return response()->json([
                    'message' => 'Error. No tiene codigo',
                    'code' => -2,
                    'data' => null
                ], 404);

            }

            return response()->json([
                'message' => 'Error al actualizar el registro',
                'code' => -2,
                'data' => null
            ], 404);
         }        
         
         return response()->json([
            'message' => 'No se encontró el resistro',
            'code' => -2,
            'data' => null
         ], 404);
    }

    public function sendEmailsGerentes($reservation){
        // obtener los emails de los gerentes del hotel

        $emails = User::where('status', true)
            ->where('hotel_id', $reservation->room->hotel->id)
            ->whereHas('role', function($q){
                $q->where('name', 'Gerente');
            })
            ->pluck('email')->toArray();

        
        foreach($emails as $email){
            Mail::to($email)->send(new ReservationCreatedEmail($reservation));
        }
    }

    // obtener el monto total de la reservacion y guardar las rooms
    public function getAmountReservation( $request,  $reservation){ // IMP THIS CONT
        // get hotel y base people de ese hotel
        $hotel = Hotel::where('slug', $request->hotel_slug)
            ->with(['types' => function($q) use ($reservation){
                $q->where('type_id', $reservation->room->type->id);
            }])->first();

        
        // recorrer las habitaciones (numero de personas por habitacion
        
        foreach($request->guest_numbers as $personas){
            // checar si habr;á pago extra
            $extra_payment = 0;
        
            if($personas > $hotel->types[0]->pivot->base_people){
                
                $extra_personas = $personas - $hotel->types[0]->pivot->base_people;

                $extra_payment = $extra_personas * $hotel->types[0]->pivot->extra_per_person;

            }

            // fecha de llegada y salida

            $fecha1 = $request->check_in;
            $fecha2 = $request->check_out;

            // guardar el monto filnal
            $final_amount = 0;

            // obtener el precio del schedule (de cada dia)
            for($i = $fecha1; $i < $fecha2; $i = date("Y-m-d", strtotime($i ."+ 1 days"))){
                $price_schedule =  Schedule::where('date',$i)
                    ->where('type_id',$reservation->room->type->id)
                    ->where('hotel_id',$reservation->room->hotel->id)
                    ->with(['rates' => function($q) use($reservation){
                    $q->where('rate_id', $reservation->rate->id);
                    }])
                    ->first();

                //obtener el final amount
                if($price_schedule){

                    if($price_schedule->rates[0] != null){
                        $final_amount += ($price_schedule->rates[0]->pivot->price + $extra_payment);
                    }

                }
            }


            // crear registro
            $reservation_rooms [] = ReservationRoom::create([
                'final_amount' => $final_amount,
                'number_of_people' => $personas,
                'type_id' => $request->type_id,
                'hotel_id' => $hotel->id,
                'reservation_id' => $reservation->id
            ]);

            // sumar al precio final de la reservacion
            $reservation->amount += $final_amount;

            //check cupon(si el request tiene uno)
            if(isset($request->coupon_code)){
                $discount_amount = (new CouponController)->get_amount_discount($request,$reservation,$reservation_rooms);

                if($discount_amount != false){
                    $reservation->amount = $discount_amount;
                }
            }
            
            
            //checar si el monto quedo en 0 o null
            if($reservation->amount <= 0 || is_null($reservation->amount)){
                $reservation->reservations_rooms_count = count($reservation_rooms);
                ScheduleController::regresarStock($reservation);
                $reservation->delete();
                return false;
            }

            //guardarlos
            $reservation->reservations_rooms()->saveMany($reservation_rooms);
            $reservation->save();

            return true;
    
        }
    }

    public function get_card($id){
        $reservation = Reservation::where('id', $id)
            ->with('card')
            ->first();
    
        if(isset($reservation->card)){
            // desecriptar
            $number_encry = base64_decode($reservation->card->number);

            $ccv_encry = base64_decode($reservation->card->number);

            $reservation->card->number_decrypt = openssl_decrypt($reservation->card->number, $this->method, $this->clave, false, base64_decode($this->iv));

            $reservation->card->cvv_decrypt = openssl_decrypt($reservation->card->cvv, $this->method, $this->clave, false, base64_decode($this->iv));
            
            return response()->json([
                'message' => 'Registro obtenido exitosamente',
                'code' => 2, 
                'data' => $reservation->card
            ]);

        }


        return response()->json([
            'message' => 'Error al encotrar registro',
            'code' => 2,
            'data' => null
        ], 200);

    }
 
    public function create_reservation(Request $request){
     /*  $request['client_id'] = 1;
        $request['rate_id'] = 1;
        $request['token']  = 'd2#jyi@rah%sEd';
        $request['user']  = 'grivera@hotelsevencrown.com';
        $request['guest_numbers'] = [1];
        $request['check_in'] = Carbon::createFromFormat('Y-m-d','2021-03-17');
        $request['hotel_slug'] = 'la-paz-malecon';
        $request['room_slug'] = 'estandar-sencilla';
        $request['type_id'] = '1';
        $request['check_out'] = Carbon::createFromFormat('Y-m-d','2021-03-17')->addDays(2);  */
        $user = User::where('email', $request->user)->first();
        
        // validar credenciales 

        if(Hash::check($request->token, $user->password)){

            // buscar el cliente
            $client = Client::where('id', $request->client_id)->first();

            if($client){

                // error_log(json_encode($client));
                $request['client_id'] = $client->id;
            
                // checar la disponibilidad
                $available = ScheduleController::check_availability($request);

                // error_log(json_encode($available));
                if($available){
                    // obtener el room_id

                    $room = Room::withAndWhereHas('hotel', function($q) use ($request){
                        $q->where('slug', $request->hotel_slug);
                    })
                    ->where('slug', $request->room_slug)
                    ->first();

                    if($room){
                        $request['room_id'] = $room->id;
                    }
                    // crear la reservacion 

                    $reservation = Reservation::create($request->all());

                    // crear los datos de facturaci;ón (si los manda)

                    if($request->billing ){
                        $facturation_data = FacturationData::create([
                            'razon_social' => $request->razon_social,
                            'document_type' => $request->document_type,
                            'document_number' => $request->document_number,
                            'address' => $request->address,
                            'zip_code' => $request->zip_code,
                            'state' => $request->state,
                            'city' => $request->city,
                            'reservation_id' => $reservation->id,
                            'country_id' => $request->coutry_id,
                            'email' => $request->facturation_email,
                            'tax_postal_code' => $request->tax_postal_code,
                            'tax_regime' => $request->tax_regime
                        ]);
                    }

                    if($reservation){
                        // cargar info relacionada con la reservacion
                        $reservation->loadMissing('room','rate','client','facturacion_data.country');
                        $reservation->room->load(['hotel']);
                        $reservation->room->load(['type']);


                        // restar el stock
                        $stock_status = $this->restar_stock($request);

                        // varificar que el stock se rest;ó correctamente
                        if($stock_status){

                            // obtener el monto de la reserva
                            $get_amount = $this->getAmountReservation($request, $reservation);

                            // si el monto no es mayor a 0, se elimina la reservaci;ón

                            if(!$get_amount){
                                return response()->json([
                                    'message' => 'Error al crear reservacion',
                                    'code' => -1,
                                    'data' => null
                                ], 404);
                            }

                            // cargar las habitaciones
                            $reservation->load('reservations_rooms');

                            if(isset($request->services) && count($request->services) > 0){
                                foreach($request->services as $key => $service){
                                    $servicio = Service::select('id', 'price_per_night')
                                        ->where('id', $service['id'])
                                        ->first();

                                    // obtener el total del monto del servicio 
                                    $total_service = 0;
                                    $total_service = $service['applies_only_the_first_night'] ? $service->price_per_night : ($service->price_per_night * $request->nights_reserved);

                                  
                                    $reservation->services()->attach($service['id'], [
                                        'applies_only_the_first_night' => $service['applies_only_the_first_night'],
                                        'total_service' => $total_service,
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);

                                    // sumar a la reservacion 

                                    $reservation->amount+= $total_service;

                                }

                                // actualizar el precio de la reservacion
                                $reservation->save();
                            }

                            // mandar emails a gerentes del hotel 
                            $reservation->load('services');

                            $this->sendEmailsGerentes($reservation);

                            return response()->json([
                                'message' => 'Reservacion creada exitosamente',
                                'code' => 2, 
                                'data' => $reservation->id
                            ], 200);
                        }

                        // eliminar en caso de stock negativo
                        $reservation->delete();

                        return response()->json([
                            'message' => 'Habitacion(es) no disponibles',
                            'code' => -5,
                            'data' => null,
                        ], 404);
                    }

                    return response()->json([
                        'message' => 'Error al crear reservacion',
                        'code' => -5,
                        'data' => null
                    ], 404);
                }

                return response()->json([
                    'Habitacion (es) no disponibles',
                    'code' => -5,
                    'data' => null,
                ],  404);
            }

            return response()->json([
                'message' => 'Error al encontrar usuario',
                'code' => -5,
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Error en la autenticacion',
            'code' => -5,
            'data' => null
        ], 404);
    }

    public function restar_stock($request){

        //array de los dias a los cuales se les rest;ó el stock (en caso de que se necesite  cancelar)
        $stock_dates = [];

        // restar un dia a end date
        $last_day = date('Y-m-d', strtotime($request->check_out. "- 1 days"));

        // get hotel
        $hotel = Hotel::where('slug', $request->hotel_slug)->first();

        $schedules = Schedule::where('status', true)
            ->whereBetween('date', [$request->check_in, $last_day])
            ->where('stock', '>', 0)
            ->where('hotel_id', $hotel->id)
            ->where('type_id', $request->type_id)
            ->get();

        // restar el stock y añadir a reserved

        foreach($schedules as $schedule){
            $schedule->stock -= $request->rooms_quantity;
            $schedule->reserved += $request->rooms_quantity;
            $schedule->save();

            
            // guardar la fecha de los stocks que se han modificado
            array_push($stock_dates, $schedule->date);

            // si el stock queda en numeros negativos, no se puede hacer la reservacion 
            if($schedule->stock < 0){
                $this->reset_stock($request, $stock_dates);

                return false;
            }
        }
        return true;
    }


    // restaurar el stock en cado de obtener un stock negativo al realizar una reservacion 
    public function reset_stock($request, $stock_dates){
        // definir fecha de inicio y fin 
        $start_date = $stock_dates[0];
        $end_date = $stock_dates[sizeof($stock_dates)-1];

        // get hotel  
        // >:v
        $hotel = Hotel::where('slug', $reservation->hotel_slug)->first();

        $schedules = Schedule::where('status', true)
            ->whereBetween('date', [$start_date, $end_date])
            ->where('hotel_id', $hotel->id)
            ->where('type_id', $request->type_id)
            ->get();
        
        if($schedules){
            // restar el stock y añadir a reserved
            foreach($schedules as $schedule){
                $schedule->stock += $request->rooms_quantity;
                $schedule->reserved -= $request->rooms_quantity;
                $schedule->save();
            }
        }
    }

    // obtener info de la reservacion
    public function get_reservation_by_id(Request $request){
      /*   $request['token']  = 'd2#jyi@rah%sEd';
        $request['user']  = 'grivera@hotelsevencrown.com';
        $request['reservation_id'] = '1'; */
        $user = User::where('email', $request->user)->first();

        // validar credenciales
        if(Hash::check($request->token, $user->password)){
           
            $reservation = Reservation::where('id', $request->reservation_id)
                ->with('client', 'room.hotel', 'reservations_rooms', 'coupons', 'services')->first();

            if($reservation){

                return response()->json([
                    'message' => 'Registro cosultado exitosamente',
                    'code' => 2,
                    'data' => $reservation
                ], 200);

            }

            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => -5,
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Error en la autenticaci;ón',
            'code' => -5,
            'data' => null
        ], 404);

    }

    // obtener info de la reservacion (cliente) 
    public function get_reservation_client(Request $request){
    /*     $request['token']  = 'd2#jyi@rah%sEd';
        $request['user']  = 'grivera@hotelsevencrown.com';
        $request['code']  = 'RES20200827';
        $request['email'] = 'Jose@gmail.com';
        $request['hotel_id'] = '1';
 */
        $user = User::where('email', $request->user)->first();

        // validar credenciales
    
        if(Hash::check($request->token, $user->password)){

            // buscar cliente
            $reservation = Reservation::where('code', $request->code)
                ->orderBy('id', 'DESC')
                ->withAndWhereHas('client', function($q) use($request){
                     $q->where('email', $request->email);
                })
                ->withAndWhereHas('room.hotel', function($q) use ($request){
                    $q->where('id', $request->hotel_id);
                })
                ->with('reservations_rooms')
                ->first();

            
            if($reservation){

                return response()->json([
                    'message' => 'Registro consultado correctamente',
                    'code' => -2,
                    'data' => $reservation
                ], 200);

            }


            return response()->json([
                'message' => 'Error al encontrar registro',
                'code' => -5,
                'data' => null,
            ], 404);

        }

        return response()->json([
            'message' => 'Error en la autenticacion',
            'code' => -5,
            'data' => null
        ] , 404);
    }


    // obtener informacion de la reservacion (codigo)
    function get_reservation_code(Request $request){

        $user = User::where('email', $request->email)->first();

        // validar credenciales
        if(Hash::check($request->token, $user->password)){

            $reservation = Reservation::where('code', $request->code)
                ->orderBy('id', 'DESC')
                ->withAndWhereHas('client', function($q) use ($request){
                    $q->where('email', $request->email);
                })
                ->with('reservations_rooms')
                ->first();

            if($reservation){

                return response()->json([
                    'message' => 'Registro consultado correctamente',
                    'code' => 2, 
                    'data' => $reservation
                ], 200);
            }

            return response()->json([
                'message' => 'Error al encontrar registro',
                'code' => -2,
                'data' => $reservation
            ], 404);
        }

        return response()->json([
            'message' => 'Error en la autenticacion',
            'code' => -5,
            'data' => null
        ], 404);
    }


}

