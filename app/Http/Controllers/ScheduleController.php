<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    // restaurar stock al cancelar
    public static function regresarStock($reservation){
        // restar un dia a end date

        $last_day = date('Y-m-d', strtotime($reservation->check_out.' - 1 days'));
       
        $schedules = Schedule::where('status',true)
        ->whereBetween('date',[$reservation->check_in,$last_day])
        ->where('hotel_id',$reservation->room->hotel->id)
        ->where('type_id',$reservation->room->type->id)
        ->get();

        if($schedules){
            // regresar el stock y añadir a reserved 
            foreach($schedules as $schedule){
                $schedule->stock += $reservation->reservations_rooms_count;
                $schedule->reserved -= $reservation->reservations_rooms_count;

                $schedule->save();
            }
        }

    }

    public static function check_availability($request){

      
        // rstar un dia a end date

        $last_day = date('Y-m-d', strtotime($request->check_out. ' -1 days'));

        // obtener la habitaci;ón del hotel y su tipo

        $schedules = Schedule::where('status',true)
            ->whereBetween('date',[$request->check_in,$last_day])
            ->where('stock', '>', 0)
            ->withAndWhereHas('hotel', function($q) use($request){
                $q->where('slug', $request->hotel_slug);
            })
            ->withAndWhereHas('type', function($q) use($request){
                $q->where('id', $request->type_id);
            })
            ->with('rates')
            ->orderBy('date','DESC')
            ->get();
        

            // error_log(json_encode($schedules));

        if(count($schedules) > 0){
            // cargar el hotel 
            $schedules->loadMissing('hotel');

            // agrupar por hotel
            $schedules->hotels = $schedules->groupBy('hotel.name');

            // dd(json_encode($schedules));

            if(count($schedules->hotels) > 0){

                foreach($schedules->hotels as $key => $dia){
                    
                    // cargar el tipo y max people del hotel
                    $schedules->hotels[$key]->load(['type.hotels' => function($q) use($dia){
                        $q->where('hotels.id', $dia[0]->hotel_id);
                    }]);

                    // agrupar por tipo
                    $schedules->hotels[$key] = $dia->groupBy('type.name');

                }
            }

            // recorrer dias de la reservacion 
            $fecha1 = $request->check_in;
            $fecha2 = $request->check_out;


            //  error_log(json_encode($schedules->hotels));


            // recorrer los hoteles
            foreach($schedules->hotels as $hotel_key => $types){

                // recorrer los tipos
                foreach($types as $type_key => $type){

                    // error_log(json_encode($type));

                    for($i = $fecha1; $i < $fecha2; $i = date('Y-m-d', strtotime($i . ' + 1 days'))){

                        // error_log(json_encode($i));


                        // verificar que el dia est;é disponible
                        // $available_day = $type->where('date', '2021-03-18');
                        $available_day = $type->where('date', $i);

                        // error_log(json_encode('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>'));
                        // error_log(json_encode($available_day));
                        // json_encode($type);

                        if(sizeof($available_day) == 0) {
                            // retirnar false si no está disponible ese rango de dias
                            return false;
                        }else{


                            // guardar como quedaria el stock al hacer la reservacion
                            $final_stock = $available_day->first()->stock - $request->rooms_quantity;
                            // error_log('!!!!!!!!!!!!!!!!!!!!!!!!!!');
                            // error_log(json_encode($final_stock));

                            // validar si el stock queda en negativo
                            if($final_stock < 0){
                                // no mandar el tipo de habitaci;ón si no est;án disponibles los cuartos que se piden
                                unset($schedules->hotels[$hotel_key][$type_key]);
                            }

                            // verificar la disponibilidad del numero de personas de los rooms 
                            foreach($request->guest_numbers as $guest_number){
                                if($guest_number > $available_day->first()->type->hotels[0]->pivot->max_people){

                                    //retornar false si no pueden entrar todas las personas al room
                                    return false;

                                }
                            }
                        }

                    }
                }
            }

            // si hay disponibilidad retornar true
            // error_log('DISPONIBLE');
            return true;
        }

        // si no encuentra schedules retornar false
        return false;
    }
}
