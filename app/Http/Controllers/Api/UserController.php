<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class UserController extends Controller
{
    public function destroy($id){
        
        $user = User::find($id);
        // return $user;
        if($user){
            LogController::store(Auth::user()->id, 'Eliminar',$id ,'Elimino un usuario', 'users', request()->route()->getPrefix().'/'.$user->email);
            $user->delete();

            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 2,
                'data' => null 
            ]);
        }

        LogController::store(Auth::user()->id, 'Error', $id, 'Ha ourrido un error', 'users', request()->route()->getPrefix().'/'.$id);
       
        return response()->json([
          'message' => 'Ha ocurrido un error',
            'code' => -2,
            'data' => $id 
        ], 404);
      
    }
}
