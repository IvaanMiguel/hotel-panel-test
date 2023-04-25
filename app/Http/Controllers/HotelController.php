<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Reply;
use App\Models\Room;
use Carbon\Carbon;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $breadcrum_info = array(
        "main_title" => "Hoteles",
        "second_level" => "",
        "add_button" => true
      ); 


    public function index()
    {
        $breadcrum_info = $this->breadcrum_info;

        $is_admin = true; // !!!!!!!!!!!!!!!!!!!!! auth 

        $breadcrum_info['add_button'] = $is_admin;

        // traer el hotel al que pertenece (todos si es admin o sistemas)
        $hotels = Hotel::where('status', true)
            ->with('images')
            ->with(['rooms' => function($q){
                $q->withCount('reservations');
            }])
            ->when(!$is_admin, function($q){
                $q->where('id', 1);
            })
            ->get();

            // obtener el numero de reservaciones por hotel

            foreach($hotels as $hotel){
                $hotel->total_reservations = array_sum(array_column($hotel->rooms->toArray(), 'reservations_count'));
            }


            // ordenar los hoteles de mayor a menor (total_reservas)
            $hotels_array = $hotels->toArray();
            array_multisort(array_column($hotels_array, 'total_reservations'), SORT_DESC, $hotels_array);


            // hotel con mas reservaciones
            $most_reserved = $hotels_array[0];
            // hotel con menos reservaciones
            $less_reserved = $hotels_array[sizeof($hotels_array) - 1];

            LogController::store(1, 'Consultar', 0, 'Consiltar todos los hoteles', 'hotele', '/hotels', 'index hotel');

            
            return view('hotels.index' , compact( 'hotels', 'most_reserved', 'less_reserved', 'breadcrum_info'));
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
/*         $request['name'] = 'asdasd';
        $request['address'] = 'daressssss';
        $request['phone_number'] = '12313121312';
        $request['email'] = 'joel@mail.com';
        $request['url_address'] = 'goo.gle.asdasdasda';
        $request['slug'] = 'asdasd-asdasda-dasd-asdasd-adasda';
        $request['status'] = '1'; */


        $validator = Validator::make($request->all(),[
            'email' => 'unique:hotels',
            'slug' => 'unique:hotels'
        ]);

        if($validator->passes()){
            $hotel = Hotel::create($request->all());

            if($hotel){

                // guardar cover

                if($request->hasFile('cover')){
                    $file = $request->file('cover');
                    $name_file = $hotel->slug.'_portada.'.$file->getClientOriginalExtension();

                    $path = $request->file('cover')->storeAs(
                        '/img/hotels', $name_file
                    );

                    $hotel->cover = $name_file;
                    $hotel->save();
                }

                // return 'SUCCESS';
                LogController::store(1, 'Registrar', $hotel->id, 'registro de un nuevo hotel', 'hotels', '/hotels/', $hotel->slug);
                return redirect()->back()->with('success', 'ok');
            }

            // return 'ERROR';
            LogController::store(1, "Error", 0, 'Error al registrar un hotel', 'hotels', '/hotels');
            return redirect()->back()->with('error', 'error en el servidor');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $breadcrum_info = $this->breadcrum_info;
        $breadcrum_info['second_level'] = 'Detalles';
        $breadcrum_info['add_button'] = false;

        $hotel = Hotel::where('slug', $slug)->with('images')->first();

        if($hotel){

            //obtener la srespuestas del hotel
            $replies = $this->get_replies_hotel($hotel);
         
            // get widgets
            $widgets = $this->get_widgets($hotel->id, $replies);

            // obtener reservas de los ultimos 6 meses
            $chartInfoMonths = $this->hotelChartInfoMonths($hotel);

            // obteneer reservas de la ultima semana
            $chartInfoWeek = $this->hotelChartInfoWeek($hotel);

            LogController::store(1, 'Consultar', $hotel->id, 'Consultar un hotel', 'hotels', '/hotels/'.$slug , 'hotels');
      
            return view('hotels.details', compact('hotel', 'breadcrum_info', 'chartInfoMonths', 'chartInfoWeek', 'replies', 'widgets'));


        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        
        $hotel = Hotel::where('id', $request->hotel_id)->first();

        if($hotel->update($request->all())){

            if($request->hasFile('cover')){
                $file = $request->file('cover');

                $new_file_name = 'hotel_cover_'.$hotel->id.'.'.$file->getClientOriginalExtension();

                $path = $request->file('cover')->storeAs(
                    'images/hotels', $new_file_name
                );
                $hotel->cover = $new_file_name;

                $hotel->save();
            }


            LogController::store(1, 'Actualizar', $hotel->id, 'Actualizo un hotel', 'hotel', '/hotels/'.$hotel->slug, $hotel);
            return redirect()->back()->with('success', 'ok');
            // return 'SUCCESS';
            
        }
        // return 'ERROR';
        LogController::store(1, 'Error', $hotel->id, 'Error al actualizar un hotel', 'hotel', '/hotels/'.$request->id);
        return redirect()->back()->with('error', 'error en el servidor');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        //
    }

    public function get_replies_hotel($hotel){
        
        $replies = Reply::select('id','observations','questionnaire_id','reservation_id')
        ->whereHas('reservation', function($q) use($hotel){
           $q->whereHas('room', function($q) use($hotel){
               $q->where('hotel_id', $hotel->id);
           });
        })
        ->with(['reservation' => function($q) {
           $q->select('id','code','check_in','client_id','room_id');
           $q->with('client:id,name,email');
           $q->with(['room' => function($q) {
               $q->select('id','name','hotel_id');
               $q->with('hotel:id,name');
           }]);
        }])
        ->get();

        return $replies;
    }


    public function get_widgets($hotel_id, $replies){
        $widgets = collect();

        //cantidad de reservaciones
        $rooms = Room::where('hotel_id',$hotel_id)
                 ->select('id','hotel_id')
                 ->withCount(['reservations' => function($q) {
                    $q->where('status','confirmada');
                 }])
                 ->get();

        $widgets->put('reservations_count', $rooms->sum('reservations_count'));
        $widgets->put('replies_count', $replies->count());

        return $widgets;
    }

    public function hotelChartInfoMonths($hotel){
        $meses = [
            'meses' => []
        ];

        $date = date('Y-m-d');

        // obtener los unitmos 6 meses
        for($i = 0; $i < 6; $i++){
            array_push($meses['meses'], $this->chartByMonth($date, $hotel));

            $date = date('Y-m-d', strtotime($date."-1 month"));
        }

        return $meses;
    }

    public function chartByMonth($date, $hotel){
        $meses = array("Mes","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        //obtener el mes y año de la fecha dada
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        //obtener las habitaciones del hotel y sus reservaciones
        $rooms = Room::where('hotel_id',$hotel->id)
                 ->withCount(['reservations' => function($q) use($year,$month){
                      $q->where('status','confirmada');
                      $q->whereYear('created_at',$year);
                      $q->whereMonth('created_at',$month);
                  }])
                 ->get();

        //mes
        $mes = array(
            'mes' => array(
                'name' => $meses[(int)$month],
                'cantidad' => $rooms->sum('reservations_count')
            )
        );

        return $mes;

    }


    public function chartByDay($date, $hotel){
          //dias
          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

          //obtener el mes y año de la fecha dada
          $day = date('d', strtotime($date));
          $month = date('m', strtotime($date));
          $year = date('Y', strtotime($date));
  
  
          //obtener las habitaciones del hotel y sus reservaciones
          $rooms = Room::where('hotel_id',$hotel->id)
                   ->withCount(['reservations' => function($q) use($year,$month,$day){
                        $q->where('status','confirmada');
                        $q->whereYear('created_at',$year);
                        $q->whereMonth('created_at',$month);
                        $q->whereDay('created_at',$day);
                    }])
                   ->get();
  
          $dia = [
              'dia' => [
                  'name' => $dias[date('w', strtotime($date))],
                  'cantidad' => $rooms->sum('reservations_count')
                ]
            ];
  
          return $dia;
    }

    public function hotelChartInfoWeek($hotel){

        //guardar info de la grafica
        $dias = array(
            'dias' => array()
        );
        $date = date('Y-m-d');
        //obtener los ultimos 6 dias
        for($i = 0; $i < 7; $i++){

            array_push($dias['dias'],$this->chartByDay($date,$hotel));
            //restar un mes
            $date = date('Y-m-d',strtotime($date."- 1 day"));
    
        }
        return $dias;
    }

    public function getCollectionReservations($rooms){
        $reservations = [];

        // recorre las habitaciones y sus reservaciones
        foreach($rooms as $room){
            foreach($room->reservations as $reservation){
                array_push($reservations, $reservation);
            }
        }

        $reservations = collect($reservations);
        return $reservations;
    }
}
