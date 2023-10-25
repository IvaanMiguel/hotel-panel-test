<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Hotel;
use App\Models\Rate;
use App\Models\Schedule;
use App\Models\Type;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Catch_;

class ScheduleController extends Controller
{
    public $breadcrumb_info = [
        "main_title" => "Planeacion",
        "second_level" => "",
        "add_button" => false
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //  Auth::loginUsingId(1);
        $current_user = Auth::user();

        $hotel = Hotel::select('id', 'name', 'slug')->when(isset($current_user->hotel_id), function($q) use($current_user){
            $q->where('id', $current_user->hotel_id);
        })->first();

        // tipos del hotel
        $type_ids = $hotel->rooms()->pluck('type_id')->toArray();
        $hotel->types = Type::select('id', 'name')->find($type_ids);

        // return $type_ids;
    
        $breadcrumb_info = $this->breadcrumb_info;

        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar planeacion', 'schedules', request()->url());

        return view('schedules.index', get_defined_vars());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
/*         $request->merge([
            'date' => Carbon::now(),
            'stock' => 212,
            'room_id' => 1
        ]);  */
        $validator = Validator::make($request->all(),[
            'date' => 'required|date',
            'stock' => 'required|numeric',
            'room_id' => 'required|exists:rooms,id'
        ]);

        if($validator->passes()){

            if($schedule = Schedule::create($request->all())){
                
                LogController::store(Auth::user()->id, 'agregar', $schedule->id, 'agregar planeacion', 'shedules',$request->url());
                return back()->with('status', 'ok');

            }
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al agregar planeacion', 'schedules', $request->url());
        return back()->withErrors($validator->errors());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        $breadcrumb_info = $this->breadcrumb_info;
      
        if($schedule){
            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar planeacion', 'schedules', request()->url());            
            return view('schedules.show', get_defined_vars());
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al consultar planeacion','schedules', request()->url());
        return back()->with('status', 'error');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        /*  $request->merge([
            'id' => 2,
            'date' => Carbon::now()->addDays(2),
            'stock' => 11,
            'room_id' => 2
        ]); */ 

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'stock' => 'required|numeric',
            'room_id' => 'required|exists:rooms,id'
        ]);

        if($validator->passes()){
           
            $schedule = Schedule::find($request->id);

            if($schedule && $schedule->update($request->all())){

                LogController::store(Auth::user()->id, 'actualizar', $schedule->id, 'actualizar planeacion', 'schedules', $request->url());
                return back()->with('status', 'ok');

            }

        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al actualizar planeacion', 'schedules', $request->url());
        return $validator->error();
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if($schedule && $schedule->delete()){
            
            LogController::store(Auth::user()->id, 'eliminar', $id, 'eliminar una planeacion', 'schedules', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamente', 
                'code' => 1,
                'data' => $id
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar una planeacion', 'schedules', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function get($id){
        
        $schedule = Schedule::find($id);

        if($schedule){
            
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 1,
                'data' => $schedule
            ]);
        }

        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function check_availability(Request $request){

    /*     $request->merge([
            'room_id' => 8,           
            'hotel_id' =>2,
            'type_id' => 4,
            'check_in' => '2023-11-12',
            'check_out' => '2023-11-13'
        ]);
        
        $schedules = Schedule::withWhereHas('room', function($q) use ($request){
            $q->where('id', $request->room_id);
            $q->where('hotel_id', $request->hotel_id);
            $q->where('type_id', $request->type_id);
        })
        ->whereBetween('date', [
            $request->check_in,
            $request->check_out
        ])
        ->where('stock', '>', 0)
        ->with('rates')
        ->orderBy('date', 'DESC')
        ->get();


        if($schedules->isEmpty()) {
            return false;
        }

        // return $schedules;
        $start_date = $request->check_in;
        $end_date = $request->check_out;
      
        $period = CarbonPeriod::create($request->check_in, $request->check_out);

        foreach($period as $day){

            $day = date_format($day, 'Y-m-d');
            
            $available_day = $schedules->where('date', $day);

    
    
        }
    
        return $period; */
        
    }


    // obtener la programacion (ajax)
    public function get_schedules(Request $request){
    
        $hotel = Hotel::select('id', 'name', 'slug')
                        ->with(['rooms.schedules' => function($q){
                            $q->with('rates');
                            $q->where('date', '>=', date('Y-m-d'));
                        }])->find(1);   
    }
}
