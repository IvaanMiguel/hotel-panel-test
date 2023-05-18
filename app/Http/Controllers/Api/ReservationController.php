<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ScheduleController;
use App\Mail\ReservationCanceledEmail;
use App\Mail\ReservationCreatedEmail;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Schedule;
use App\Models\ReservationRoom;
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
                $q->where('type_id', $reservation->rooms->type->id);
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
/* 
    public function create_reservation(Request $request){
        $user = User::where('email', $request->user)->first();
        
        // validar credenciales 

        if(Hash::check($request->token, $user->password)){

            // buscar el cliente
        }
    } */ 
}

