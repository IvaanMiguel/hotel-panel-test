<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Rate;
use App\View\Components\Breadcrumb;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Mail\CancelledReservarionEmail;
use App\Mail\CancelledReservationEmail;
use App\Mail\ConfirmedReservationEmail;
use App\Models\User;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Mockery\CountValidator\AtMost;
use Psy\Command\WhereamiCommand;

use function Laravel\Prompts\error;

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
    /*     $by = 'check_out';
        $start_date = '2023-10-16';
        $end_date = '2023-10-17';  */

        if(!isset($start_date, $end_date, $by)){
            $between_dates = false;
        }else{
            $between_dates = true;
        }

        
        $breadcrum_info = $this->breadcrum_info;
        $widgets = $this->get_widgets();
        $reservations = Reservation::with('room.hotel:id,name', 'client:id,name,email', 'rate')
        ->when($between_dates, function($q) use($start_date, $end_date, $by){
            $q->whereBetween($by, [$start_date, $end_date]);
            $q->orderBy($by);
        }, function($q){
            $q->whereDate('check_out', '>', now());
            $q->orderBy('check_out');
        })
        ->get(); 
        $clients = Client::all();
        $rooms = Room::all();

        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar reservaciones', 'reservations', request()->url());
        return view('reservations.index', get_defined_vars());
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
        $request['check_out'] = date('Y-m-d', strtotime($request->check_in . "+ " . $request->nights_reserved . " days"));

        $reservation = Reservation::create($request->all());

        if($reservation)
        {
            $log = new LogController;
            $log->store(Auth::user()->id, "Registrar",$reservation->id, "registro una nueva reservacion", "reservations" , request()->url());

            return redirect()->back()->with('success','ok');
        }

        $log = new LogController;
        $log->store(Auth::user()->id, "Error",0, "error al registrar una reservación", "reservations" , request()->url());

        return redirect()->back()->with('error','error servidor');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $breadcrum_info = $this->breadcrum_info;
        $breadcrum_info['second_level'] = "Detalle de la reservación";
        $breadcrum_info['add_button'] = false;

        $reservation = Reservation::with('room.hotel', 'rate', 'coupon', 'billing_data')
                        ->with('client', function($q){
                            $q->with('reservations');
                            $q->withCount('contacts');
                            $q->withCount(['reservations as completas' => function($q){
                                $q->where('status','confirmada');
                            }]);
                            $q->withCount(['reservations as canceladas' => function($q){
                                $q->where('status','cancelada');
                            }]);
                        })
                        ->find($id);

        $rooms = Room::all();
        $clients = Client::all();
        $rates = Rate::all();

        if($reservation){
            LogController::store(Auth::user()->id, 'consultar', $reservation->id, 'consultar una reservación', 'reservations', request()->url());
            return view('reservations.show', get_defined_vars());
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'error en servidor', 'reservations', request()->url());
    }


    public function get($id)
    {
        $reservation = Reservation::with('room', 'rate', 'client')
                        ->find($id);

        if($reservation){
            LogController::store(Auth::user()->id, 'Obtener', $id, 'Obtener una reservación', 'reservations', request()->url());
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 1,
                'data' => $reservation
            ]);
        }

        LogController::store(Auth::user()->id, 'Error', $id, 'Error al obtener la reservación', 'reservations', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => 1,
            'data' => $id
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {   
        
  /*        $request->merge([
            'id' => 1,
            'code' => '652989BA0E023',
            'status' => 'confirmada'
        ]); */
        $validator = Validator::make($request->all(), [
            'code' => 'unique:reservations,code,'.$request->id
        ]);

        if($validator->passes()){

            $reservation = Reservation::find($request->id);


            if($reservation && $reservation->update($request->all())){

                if($reservation->status == 'confirmada' && isset($reservation->client->email)){
                         
                    Mail::to($reservation->client->email)->send(new ConfirmedReservationEmail($reservation, $reservation->client));
                 
                }
                
                LogController::store(Auth::user()->id, 'Actualizar', $reservation->id, 'Actualizar una reservacion', 'reservations', FacadesRequest::getRequestUri().'/'. $reservation->code);
       
                return back()->with('status', 'ok');
            }

            
        }
        LogController::store(Auth::user()->id, 'Error', $request->id, 'error al actualizar una reservacion', 'reservations', FacadesRequest::getRequestUri().'/'. $request->id);
        
        return back()->with('status', 'error');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get_widgets(){
        
        $reservations = Reservation::get();
        $statuses = ['confirmada', 'pendiente', 'cancelada', 'inconclusa'];
        $widgets = collect();
        foreach($statuses as $status){
            $widgets->push([
                'status' => $status,
                'count' => $reservations->where('status', $status)->count()
            ]);
        }

        return $widgets;
    }

    //
    public function change_status(Request $request){
        
        $request['id'] = 4;
        $request['status'] = 'cancelada';
        $reservation = Reservation::find($request->id);


        if(!is_null($reservation) && $request->status == 'confirmada' && $reservation->status == 'pendiente'){
            
            $reservation->update(['status' => $request->status, 'code' => $request->code]);

            if(isset($reservation->client->email)){

                Mail::to($reservation->client->email)->send(new ConfirmedReservationEmail($reservation, $reservation->client));               
            }
        
        }else if(!is_null($reservation) && $reservation->status == 'cancelada') {

            $reservation->update(['status' => $request->status]);

            if(isset($reservation->client->email)){

                Mail::to($reservation->client->email)->send(new CancelledReservationEmail($reservation, $reservation->client));
            }

        }
    
    }
}
