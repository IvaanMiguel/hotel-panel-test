<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Validator as ValidationValidator;

class RoomController extends Controller
{

     public $breadcrumb_info = [
        "main_title" => "Habitaciones",
        "second_level" => "",
        "add_button" => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::get();

        $hotels = Hotel::get();
        
        $breadcrumb_info = $this->breadcrumb_info;

        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar habitaciones', 'rooms', request()->url());

        return view('rooms.index', get_defined_vars());
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
       /*  $request->merge([
            'name' => 'name',
            'slug' => 'slu  qwg'.time(),
            'description' => 'desc',
            'max_people' => 2,
            'hotel_id' => 1,
            'type_id' => 1
        ]); */
        $validator = Validator::make($request->all(), [
            'cover' => 'sometimes|image',
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required|unique:rooms,slug',
            'max_people' => 'required|numeric|min:1',
            'hotel_id' => 'required|exists:hotels,id',
            'type_id' => 'required|exists:types,id'
        ]); 

        if($validator->passes()){

            if($room = Room::create($request->all())){
                
                if($request->hasFile('cover')){
                    
                    $file = $request->file('cover');
                    
                    $name_file = $room->slug.'_portada.'.$file->getClientOriginalExtension();
                    
                    $request->file('cover')->storeAs('public/rooms', $name_file);

                    Image::create([
                        'url' => $name_file,
                        'imageable_type' => 'App\Models\Room',
                        'imageable_id' => $room->id,
                        'type' => 'cover'
                    ]);
                }
                LogController::store(Auth::user()->id, 'registrar', 0, 'registrar habitaciones', 'rooms', request()->url());       
                return back()->with('status', 'ok');                
            }
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al registrar habitacion', 'rooms', request()->url());
        return back()->withErrors($validator->errors());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = Room::find($id);
        
        if($room){
            $breadcrumb_info = $this->breadcrumb_info;

            LogController::store(Auth::user()->id, 'consultar',0, 'consultar una habitacion', 'rooms', request()->url());
            
            return view('rooms.show', get_defined_vars());
        }
        LogController::store(Auth::user()->id, 'error', $id, 'error al obtener habitacion', 'rooms', request()->url());
      
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


    /*      $request->merge([
            'id' => 1,
            'name' => 'name - edit',
            'slug' => 'slu  EDIT - -'.time(),
            'description' => 'desc - EDIT',
            'max_people' => 1,
            'hotel_id' => 1,
            'type_id' => 1
        ]); */
        $validator = Validator::make($request->all(), [
            'cover' => 'sometimes|image',
            'name' => 'required',
            'description' => 'required',
            'slug' => 'required|unique:rooms,slug,'.$request->id,
            'max_people' => 'required|numeric|min:1',
            'hotel_id' => 'required|exists:hotels,id',
            'type_id' => 'required|exists:types,id'
        ]);
        error_log(json_encode($request->all()));
        if($validator->passes() && $room = Room::find($request->id)){
        
            if($room && $room->update($request->all())){

                if($request->hasFile('cover')){

                    $file = $request->file('cover');

                    $new_file_name = 'room_cover'.uniqid().'_'.$room->id.'.'.$file->getClientOriginalExtension();

                    $path = $request->file('cover')->storeAs('public/rooms/', $new_file_name);

                    $original_cover = $room->cover;

                    if($original_cover && File::exists(public_path().'/storage/rooms/'.$original_cover->url)){
                       File::delete(public_path().'/storage/rooms/'.$original_cover->url);
                    }

                    if($original_cover){
                        $original_cover->update(['url' => $new_file_name]);
                    }

                    else{
                        Image::create([
                            'url' => $new_file_name,
                            'type' => 'cover',
                            'imageable_type' => Room::class,
                            'imageable_id' => $room->id
                        ]);
                    }
                }

                LogController::store(Auth::user()->id, 'actualizar', $room->id, 'actualizar una habitacion', 'rooms', request()->url());
                return back()->with('status', 'ok');
            }
        }

        LogController::store(Auth::user()->id, 'actualizar', $request->id, 'actualizar una habitacion', 'rooms', request()->url());
        return back()->withErrors($validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = Room::find($id);

        if($room){
            $room->delete();

            LogController::store(Auth::user()->id, 'eliminar', $id, 'eliminar una habitacion', 'rooms', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id
            ]);
        }


        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar una habitacion', 'rooms', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function get($id){

        $room = Room::find($id);

        if($room){

            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar una habitacion', 'rooms', request()->url());
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 1, 
                'data' => $room
            ]);
        }


        LogController::store(Auth::user()->id, 'error', $id, 'error al consultar una habitacion', 'rooms', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
}
 