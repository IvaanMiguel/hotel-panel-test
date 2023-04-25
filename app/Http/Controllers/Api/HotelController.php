<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HotelController extends Controller
{
    public function get($slug){
        $hotel = Hotel::where('slug', $slug)->first() ?? [] ;
      
        LogController::store(1, 'Consultar', $hotel->id ?? '-', 'consulto un hotel', 'hotels', '/hotels/'.($hotel->slug ?? '-'), $slug);

        return response()->json([
            'message' => 'Registro consultado correctamente',
            'code' => 2,
            'data' => $hotel,
        ] ,200);
    }


    public function destroy($id){

        if($hotel = Hotel::find($id)){

            $hotel->status = false;

            if($hotel->save()){

                LogController::store(1, 'Eliminar', $hotel->id, 'Elimino un hotel', 'hotels', '/hotels/'.$hotel->slug);


                return response()->json([
                    'nessage' => 'Registro eliminado correctamente',
                    'code' => 2, 
                    'data' => null
                ], 200);

            }
        }
        
        LogController::store(1, 'Error', $id, 'no se pudo eliminar un hotel', 'hotels' ,'/hotels/'.$hotel->slug);

        return response()->json([
            'message' => "No se ha podido eliminar",
            'code' => 2,
            'data' => null
        ], 200);
    }


    public function get_comments_and_rates(Request $request){
        $user = User::where('email', $request->user)->first();

        // validar credenciales

        if(!Hash::check($request->token, $request->user)){
            return response()->json([
                'message' => "Error en la autenticacion",
                'code' => -5,
                'data' => null
            ], 404);
        }

            // limite de resultados
        if(!isset($request->limit)){
            $request['limit'] = 5;
        }

        // fecha de busqueda
        if(!isset($request->start_date)){
            $request['start_date'] = date('Y-m-d');
        }

        $hotel = Hotel::where('slug', $request->hotel_slug)
            ->with(['comments' => function($q) use($request){
                    $q->where('status', 'aceptado');
                    $q->orderBy('created_at', 'DESC')->limit($request->limit);
            }])
            ->with(['schedules', function($q) use ($request){
                    $q->where('status', true);
                    $q->with('type', 'rates');
                    $q->where('date', $request->start_date);
            }])
            ->get();

            if($hotel){

                return response()->json([
                    'message' => "Registro obtenido correctamente",
                    'code' => 2,
                    'data' => $hotel
                ], 200);
                
            }

        return response()->json([
            'message' => "Error en el servidor",
            'code' => -5,
            'data' => null
        ], 404);
        
    }


    public function get_comments(Request $request){
        $user = User::where('email', $request->user)->first();

        // validar credenciales

        if(Hash::check($request->token, $user->password)){

            //validar si llega limit
            if(!isset($request->limit)){
                $request['limit'] = 5;
            }


            $hotel = Hotel::where('slug', $request->hotel_slug)
                ->with(['comments' => function($q) use ($request){
                    $q->where('status', 'aceptado');
                    $q->orderBy('created_at', 'DESC')->limit($request->limit);
                }])
                ->get();



            if($hotel){

                return response()->json([
                    'message' => "Registro obtenido correctamente",
                    'code' => 2,
                    'data' => $hotel
                ], 200);
                

            }

            return response()->json([
                'message' => "Error en el servidor",
                'code' => -5,
                'data' => null
            ], 404);
        }


        return response()->json([
            'message' => "Error en la autenticacion",
            'code' => -5,
            'data' => null
        ], 404);

    }
}
