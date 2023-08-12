<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Client;
use Illuminate\Cache\Lock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ClientController extends Controller
{
    public function get($email){
   
        $client = Client::where('email', $email)
        ->with('country')
        ->first();
    
        if($client){
            LogController::store(Auth::user()->id, 'Consultar', 0, 'Consultar un cliente', 'clients', FacadesRequest::getRequestUri());  
            return response()->json([

                'message' => 'Registro consultado correctamente',
                'code' => 2,
                'data' => $client
            ]);
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'No se encontro al cliente', 'clients', FacadesRequest::getRequestUri());
        return response()->json([
            'message' => 'Ha ocurrido un error', 
            'code' => -2,
            'data' => null
        ]);
    }

    
    public function destroy($id){
        
        $client = Client::find($id);

        if($client){

            LogController::store(Auth::user()->id, 'Eliminar', $client->id, 'Elimino un cliente', 'clients', request()->route()->getPrefix().'/'.$id);
            $client->delete();

            return response()->json([
              'message' => 'Registro eliminado correctamente',
                'code' => 2,
                'data' => null
            ]);
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'No se encontro al cliente', 'clients', FacadesRequest::getRequestUri());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -2,
            'data' => $id
        ]);
    }
}
