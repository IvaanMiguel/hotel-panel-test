<?php

namespace App\Http\Controllers;

use App\Mail\ReservationConfirmedEmail;
use App\Models\Client;
use App\Models\Rate;
use Illuminate\Support\Carbon;
use App\Models\Reservation;
use App\Models\Room;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
class ReservationController extends Controller
{
    public $breadcrum_info = array(
        "main_title" => "Reservaciones",
        "second_level" => "",
        "add_button" => true
      );
    /**
     * Display a listing of the resource.
     */
    public function index($start_date = null, $end_date = null, $by = null)
    {
        $breadcrum_info = $this->breadcrum_info;

        // ver si es usuario admin o de sistemas
        $is_admin = UserController::isAdmin();

        // return $is_admin;

        //en caso de no estar definidas las fechas obtener reservaciones que la fecha de check_out aun no pasa         
        if($start_date == null && $end_date == null && $by == null){
            $between_dates = false;
            $duracion = 'Ultimo mes';
        }else{
            // si no, hacer la busqueda entre las fechas entregadas
            $between_dates = true;
            $d1 = new DateTime($start_date);
            $d2 = new DateTime($end_date);

            $diff = $d1->diff($d2)->m + ($d1->diff($d2)->y * 12);

            if($diff == 0){
                $duracion = "Untimo mes";
            }else{
                $duracion = "Ultimos " . $diff . " meses";
            }
        }

        $reservations = Reservation::with('room.hotel', 'rate', 'client')
        ->orderBy('check_out', 'DESC')
        ->when($between_dates, function($q) use ($start_date, $end_date, $by){
            $q->whereBetween(''.$by.'', [$start_date, $end_date]);
        }, function($q){
            $q->where('status', 'pendiente');
            $q->orWhere('check_out', '>=', date('Y-m-d'));
        })
        
        ->when(!$is_admin, function($q){
            $q->withAndWhereHas('room', function($q){
                $q->where('hotel_id', Auth::user()->hotel_id);
            });
        })->get();


        $rooms = Room::where('status', true)->get();
        $clients = Client::where('status', true)->get();
        $rates = Rate::where('status', true)->get();

        //mandar fecha de inicio y fin
        $dates = array(
            'start_date' => $start_date,
            'end_date' => $end_date
        );

        $reservation_status = $this->getStatusReservations($reservations);

        LogController::store(Auth::user()->id, 'Consultar', 0, 'consultar todas las reservaciones', 'reservations', '/reservations');

        // return $reservations;
        return view('reservations.index', compact('reservations', 'reservation_status', 'rooms', 'clients', 'rates', 'breadcrum_info', 'duracion', 'dates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    /*    
        $request['code'] = 'CODE';
        $request['nights_reserved'] = 1; 
        $request['amount_of_people'] = 12;
        $request['check_in'] = now();
        $request['check_out'] = Carbon::now()->addDays(3);
        $request['comments'] = 'Comenrerrqrwer werwer ';
        $request['payment_confirmation'] = true;
        $request['amount'] = 23232;
        $request['billing'] = 1;
        $request['lang'] = 'es';
        $request['source'] = 'source';
        $request['domain']  ='domain';
        $request['room_id'] = 1;
        $request['rate_id'] = 1;
        $request['client_id'] = 1;
        $request['status'] = true; */
        // $request['facturacion_data_id'] = 1;

        $request['check_out'] = date('Y-m-d', strtotime($request->check_in.'+ '.$request->nights_reserved. ' days'));

        $reservation = Reservation::create($request->all());

        if($reservation){
            LogController::store(Auth::user()->id, 'Registrar', $reservation->id, 'Registro una nueva reservacion', 'reservations', '/reservations/'.$reservation->id);

            // return $reservation;}
            return redirect()->back()->with('success','ok');

        }
        LogController::store(Auth::user()->id, 'Error', 0 ,'Error al registrar una reservacion', 'reservations', '/reservations');
        // return 'ERROR';
        return redirect()->back()->with('error','No permitido');    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $breadcrum_info = $this->breadcrum_info;
        $breadcrum_info['second_level'] = 'Detalle de reservacion';
        $breadcrum_info['add_button'] = false;

        $reservation = Reservation::where('id', $id)
        ->with('room.hotel', 'rate', 'facturacion_data','reservations_rooms' ,'coupons')
        ->with(['client' => function($q){
            $q->with('reservations');
            $q->withCount('contacts');

             $q->withCount(['reservations as completas' => function($q){
                $q->where('status', 'confirmada');
            }]);
            $q->withCount(['reservations as canceladas' => function($q){
                $q->where('status', 'cancelada');
            }]);
        }])
        ->with(['reply' => function($q){
            $q->with('questionnaires:id,title_es');
            $q->with(['answers' => function($q){
                $q->select('id', 'reply_id', 'question_id', 'option_id');
                $q->with('question:id,text_es', 'option:id,text_es');
            }]);
        }])
        ->with('services:id,name_es,description_es,price_per_night')
        ->with('additions:id,name_es,description_es,price')
        ->first();

        $rooms = Room::where('status', true)->get();
        $clients = Client::where('status', true)->get();
        $rates = Rate::where('status', true)->get();

        if($reservation){
            LogController::store(Auth::user()->id, 'Consultar', $reservation->id, 'Consultar una reservacion', 'reservations', '/reservations/'.$id);
      
            return view('reservations.show', compact('reservation', 'rooms', 'clients', 'breadcrum_info'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
/* 
        $request['code'] = 'newval';
        $request['nights_reserved'] = 2; 
        $request['amount_of_people'] = 13;
        $request['check_in'] = now();
        $request['check_out'] = Carbon::now()->addDays(3);
        $request['comments'] = 'UPDATIN ';
        $request['payment_confirmation'] = true;
        $request['amount'] = 1212121212;
        $request['billing'] = 1;
        $request['lang'] = 'es';
        $request['source'] = 'UPDATIN';
        $request['domain']  ='UPDATIN';
        $request['room_id'] = 1;
        $request['rate_id'] = 1;
        $request['client_id'] = 1;
        $request['status'] = 'conasdasdmada';  */
        $reservation = Reservation::where('id', $request->id)->first();

        // validar code unique 

        $validator = Validator::make($request->all(), [
            'code' => 'unique:reservations,code,'.$reservation->id
        ]);

        if($validator->passes()){
            if($reservation->update($request->all())){
                // mandar un correo si se confirmo la reservacion
            
                if($reservation->status == 'confirmada'){
                    $reservation->loadMissing('client');

                    Mail::to($reservation->client->email)->send(new ReservationConfirmedEmail($reservation));
              
                }

                LogController::store(Auth::user()->id, "Actualizar", $reservation->id, 'Actualizar una reservacion', 'reservations', '/reservations'.$reservation->id);
           
                // return $reservation;
                return redirect()->back()->with('success', 'ok');
            }
        }
        LogController::store(Auth::user()->id, 'Error', 0, 'Error al actualizar una reservacion','reservations' ,'/reservations/'.$reservation->id);
        // return 'ERROR';
        return redirect()->back()->with('error', 'error en el servidor');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public static function encrypt_cards(){
    
        echo("\n");
        echo "._____________."."\n";
        echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";

        //obtener las reservacions qen donde el checkout haya pasado hace un mes
        $today = date('Y-m-d');
        $date = date("Y-m-d",strtotime($today."- 1 month"));

        $count = 0;
        $reservations = Reservation::where('check_out','<=',$date)
                        ->with('card')
                        ->get();

        if($reservations){

            //encriptar las tarjetas 
            foreach ($reservations as $reservation) {

                if(isset($reservation->card)){

                    $reservation->card->update([
                        'name_card' => '000000000',
                        'number' => '000000000',
                        'cvv' => '000000000',
                        'month' => '000000000',
                        'year' => '000000000',
                        'type' => '000000000',
                        'used' => true
                    ]);

                    $count++;

                }


            }

            echo "total de tarjetas removidas: ".$count." "."\n";

            echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";
            echo "._____________."."\n";
            echo("\n");

        } 
    }


    public function getStatusReservations($reservations){
        $estados = ['confirmada','cancelada','pendiente','inconclusa'];

        //recuperar cantidad de solicitudes por status
        $all_status = array();

        foreach ($estados as $estado) {

            $status = array(
                         'status' => $estado,
                         'quantity' => $reservations->where('status',$estado)->count(),
                      );

            array_push($all_status,$status);
        }
        
        return $all_status;
    }

}
