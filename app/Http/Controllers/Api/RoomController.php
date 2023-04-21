<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Controllers\LogController;
class RoomController extends Controller
{
    public function get($id){
        $room = Room::where('id',$id)
        ->with('hotel','type')
        ->first();

        if($room){

            LogController::store(1, "Consultar",$room->id, "consulto una habitacion", "rooms" , "/rooms/".$room->slug);

            return response()->json([
                'message' => "Registro consultado correctamente",
                'code' => 2,
                'data' => $room
            ], 200);
        }else{

        // LogController::store(1, "Indevida",0, "intento obtener una habitacion", "rooms" , "/rooms");

        return response()->json([
            'message' => "Ha ocurrido un error",
            'code' => -5,
            'data' => null
        ], 404);  
        }
    }

    public function destroy($id){
        $room = Room::find($id);

        if($room){

            $room->status = false;

            if($room->save()){

                LogController::store(1, "Eliminar",$room->id, "eliminó una habitacion", "rooms" , "/rooms/".$room->slug);

                return response()->json([
                    'message' => "Registro Eliminado correctamente",
                    'code' => 2,
                    'data' => null
                ], 200);
            }
        }

        LogController::store(1, "Error",$id, "no se pudo eliminar una habitacion", "rooms" , "/rooms");
        
        return response()->json([
            'message' => "No se ha podido eliminar",
            'code' => 2,
            'data' => null
        ], 200);

    }
}
