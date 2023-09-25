<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Rate;
use App\View\Components\Breadcrumb;

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
    public function index()
    {
        $breadcrum_info = $this->breadcrum_info;
        $reservations = Reservation::with('room.hotel', 'client')
            ->orderBy('check_out', 'desc')
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

        $reservation = Reservation::find($id)
                        ->with('room.hotel', 'rate', 'coupon')
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
                        ->get();

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
        $reservation = Reservation::find($id)
                        ->with('room', 'rate', 'client')
                        ->get();

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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
