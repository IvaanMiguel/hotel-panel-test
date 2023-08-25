<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class HotelController extends Controller
{
    public function get($slug){

        $hotel = Hotel::where('slug', $slug)->first();
   
        if($hotel){

            LogController::store(Auth::user()->id, 'consultar', $hotel->id, 'Consultar un hotel', 'hotels', FacadesRequest::getRequestUri());

            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 2,
                'data' => $hotel
            ]);
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'Ha ocurrido un error', 'hotels', FacadesRequest::getRequestUri());

        return response()->json([
          'message' => 'Ha ocurrido un error',
            'code' => -2,
            'data' => null
        ], 404);

    }
}
