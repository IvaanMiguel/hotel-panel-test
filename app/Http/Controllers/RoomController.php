<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Log;
use App\Models\Room;
use App\Models\Type;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
class RoomController extends Controller
{
    public $breadcrum_info = array(
        "main_title" => "Habitaciones",
        "second_level" => "",
        "add_button" => true
      );


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $is_admin = true; 
        $rooms = Room::where('status',true)
        ->with('hotel','type','images', 'rates')
        ->withCount('reservations')
        ->orderBy('reservations_count','DESC')
        ->when(!$is_admin, function($q){
           $q->where('hotel_id',Auth::user()->hotel_id);
        })
        ->get();

        $most_reserved = $rooms->first();
        $less_reserved = $rooms->last();

        $hotels = Hotel::where('status', true)->get();
        $types = Type::where('status', true)->get();

        LogController::store(1, "Consultar",0, "consultar todas las habitaciones", "rooms" , "/rooms");

        $breadcrum_info = $this->breadcrum_info;
        // return $rooms;
        return view('rooms.index',compact('rooms','hotels','types','most_reserved', 'less_reserved','breadcrum_info'));   

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
        $validator = Validator::make($request->all(),
        [
            'slug' => 'unique:rooms'
        ]);

        if($validator->passes()){

            $room = Room::create($request->all());

            if($room){

                if($request->hasFile('cover')){
                    $file = $request->file('cover');
                    $name_file = $room->slug."_portada.".$file->getClientOriginalExtension();

                    $path = $request->file('cover')->storeAs(
                        'img/rooms/', $name_file
                    );

                    $room->cover = $name_file;
                    $room->save();
                }

                $room->rates()->attach($request->rate_ids);
                LogController::store(1, "Registrar",$room->id, "registro una nueva habitacion", "rooms" , "/rooms/".$room->slug);
                
                return redirect()->back()->with('success','ok');
            }

            LogController::store(1, "Error",0, "error al registrar una habitacion", "rooms" , "/rooms");

            return redirect()->back()->with('error','error servidor');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($room_slug, $hotel_slug)
    {
     /*    $request['room_slug'] = 'estandar-doble';
        $request['hotel_slug'] = 'la-paz-malecon'; */
        $breadcrum_info = $this->breadcrum_info;
        $breadcrum_info['second_level'] = "Detalle de habitacion";
        $breadcrum_info['add_button'] = false;

        $until = Carbon::now()->format('Y-m-d H:i:s');
        //$until = date('Y-m-d H:i:s');
        $since = Carbon::now()->subMonth(5)->format('Y-m-d H:i:s');  
        
        
        $room = Room::where('slug',$room_slug)
        ->withAndWhereHas('hotel', function($q) use($hotel_slug){
            $q->where('slug',$hotel_slug);
        })
        ->with('type','images', 'rates')
        ->with(['reservations' => function($q) use($since,$until){
            $q->orderBy('created_at','DESC');
            $q->where('status','confirmada');
            $q->whereBetween('created_at',[$since,$until]);
        }])
        ->withCount(['reservations' => function($q){
            $q->where('status','confirmada');
        }])
        ->first();
   
        $hotels = Hotel::where('status',true)->get();
        $types = Type::where('status',true)->get();

        if($room){

            //obetenr reservas de los ultimos 6 meses
            $chartInfoMonths = $this->roomChartInfoMonths($room);

            //obtener reservas de la semana
            $chartInfoWeek = $this->roomChartInfoWeek($room);

            #return $chartInfoMonths;

            LogController::store(1, "Consultar",$room->id, "consultar una habitacion", "rooms" , "/hotel/".$hotel_slug."/".$room_slug);

            return view('rooms.details',compact('room','hotels','types','chartInfoMonths','chartInfoWeek','breadcrum_info'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
/*          $request['id'] = 1;
        $request['status'] = 0;
        $request['type_id'] = 2;
        $request['hotel_id'] = 2;
        $request['extra_payment_per_person'] = 2;
        $request['slug'] = 'AAAAAAAAAAAAAAAAAAAAAAAAA';
        $request['max_people'] = '2';
        $request['description'] = '2qS';
        $request['name'] = 'name de asdasd';  */
        $room = Room::find($request->id);

        $room->load(['type' => function($q) use($room){
            $q->with(['hotels' => function($q) use($room){
                $q->select('hotels.id');
                $q->where('hotels.id', $room->hotel_id);
            }]);
        }]);

        if($room->update($request->all())){

            //actualizar el maximo de personas (en hotel_types)
            if(isset($room->type->hotels[0]->pivot->max_people)){
                $room->type->hotels[0]->pivot->max_people = $room->max_people;
                $room->type->hotels[0]->pivot->save();
            }

            if($request->hasFile('cover'))
            {   
                $file= $request->file('cover'); 
                $new_file_name = "room_cover_".$room->id.".".$file->getClientOriginalExtension();
                $path = $request->file('cover')->storeAs(
                    'images/rooms', $new_file_name
                );  
                $room->cover = $new_file_name; 

                $room->save();
            }

            LogController::store(1, "Actualizar",$room->id, "actualizó una habitacion", "rooms" , "/rooms/".$room->slug, $room);


           //  return 'qweq';
            return redirect()->back()->with('success','ok');
        }

        LogController::store(1, "Error",0, "error al actualizar una habitacion", "rooms" , "/rooms/".$request->id);

     //return 'error';
        return redirect()->back()->with('error','error servidor');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }

    public function roomChartInfoMonths($room){
        //meses
        $months = array("Mes","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $meses = array();

        $date = date('Y-m-d');

        //obtener los ultimos 6 meses
        for($i = 0; $i < 6; $i++){

            $month = date('m', strtotime($date));
            $year = date('Y', strtotime($date));

            $reservations_count = $room->reservations->filter(function($item) use($year,$month){
                return $item->created_at->year == $year && 
                        $item->created_at->month == $month &&
                        $item->status == 'confirmada';
            })->count();

            $mes = array(
                'mes' => $months[(int)$month],
                'cantidad' => $reservations_count
            );

            array_push($meses, $mes);

            //restarb un mes
            $date = date('Y-m-d',strtotime($date."- 1 month"));
    
        }

        return $meses;
    }

        //comportamiento de la habitacion la ultmia semana
    public function roomChartInfoWeek($room)
    {
        //dias
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

        $days = array();

        $date = date('Y-m-d');

        //obtener tltima semana
        for($i = 0; $i < 6; $i++){

            $reservations_count = $room->reservations->filter(function($item) use($date){
                return $item->created_at->format('Y-m-d') == $date && 
                        $item->status == 'confirmada';
            })->count();

            $day = array(
                'day' => $dias[date('w', strtotime($date))],
                'cantidad' => $reservations_count
            );

            array_push($days, $day);

            //restarb un dia
            $date = date('Y-m-d',strtotime($date."- 1 day"));
    
        }

        return $days;

    }


    public function update_max_people(Request $request)
    {

  /*       $request['type_id'] = 1;
        $request['max_people'] = 10;
        $request['hotel_id'] = 1; */

        $type = Type::where('id',$request->type_id)
                ->with(['hotels' => function($q) use($request){
                    $q->where('hotel_id', $request->hotel_id);
                }])
                ->first();

        if($type->hotels != null){

            $type->hotels()->updateExistingPivot($request->hotel_id,['max_people' => $request->max_people]);

            $log = new LogController;
            $log->store(1 , "Actualizar",1, "actualizó una habitacion", "rooms" , "/rooms/".$type->id);

            // return 'SUCCESS';
            return redirect()->back()->with('success','ok');
        }


        LogController::store(1 ,  "Error",0, "error al actualizar una habitacion", "rooms" , "/rooms/".$request->id);        
        // return 'NEL :v';
        return redirect()->back()->with('error','error servidor');
    }
}
