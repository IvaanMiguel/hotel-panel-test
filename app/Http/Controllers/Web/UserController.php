<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator as ValidationValidator;
use Spatie\Backtrace\Arguments\ReduceArgumentsAction;
use Spatie\Permission\Models\Role;



class UserController extends Controller
{
    public $breadcrum_info = array(
        "main_title" => "Usuarios",
        "second_level" => "",
        "add_button" => false
    );
 

    public function index(){
        
        $breadcrum_info = $this->breadcrum_info;

        $users = User::whereHas('roles', function($q){
            $q->where('name', 'Sistemas');
        })->get();

        $roles = Role::all();

        LogController::store(Auth::user()->id, 'Consultar', 0, 'Consultar todos los usuarios', 'users', FacadesRequest::getRequestUri());
    
        return view('users.index', get_defined_vars());
   }
/*tinker >>  (new App\Http\Controllers\Web\UserController)->store((new Illuminate\Http\Request)->merge(['name' => 'joel', 'email' => 'test@tet.com', 'password' => '123', 'password_confirmation' => '123'])) */
   public function store(Request $request){

      $request->merge([
            'name' => 'qeqwe',
            'email' => 'joel@mail.com'.time(),
            'hotel_id' => 1,
            'role_id' => 1,
            'password' => '123',
            'password_confirmation' => '123'
        ]); 

        $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|confirmed',
                'hotel_id' => 'sometimes|exists:hotels,id',
                'role_id' => 'sometimes|exists:roles,id'
            ]);
        

        if($validator->passes()){

            $request['password'] = Hash::make($request['password']);
            
            $user = User::create($request->all());
            
            if($request->has('role_id')){
                $user->assignRole($request->role_id);
            }

            #va
    
            LogController::store(Auth::user()->id, 'Registrar', $user->id, 'registro de un nuevo usuario','users',FacadesRequest::getRequestUri());
            return back()->with('success', 'ok');
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'Ha ocurrido un error', 'users', FacadesRequest::getRequestUri());
        return back()->withErrors($validator->errors());

    }

    public function show($email = null){
        
   
        $breadcrum_info = $this->breadcrum_info;
        $breadcrum_info['second_level'] = 'Perfil de usuario';
        $breadcrum_info['add_buttin'] = false;
        
        if(is_null($email)){
            $email = Auth::user()->email;
        }

        
        $user = User::where('email', $email)->first();

        if($user){

            LogController::store(Auth::user()->id, 'Consultar', $user->id, 'consultar un usuario', 'users', FacadesRequest::getRequestUri());

            return view('users.profile', get_defined_vars());
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'No se encuentra el usuario', 'users',FacadesRequest::getRequestUri());

        return back()->with('status', 'error');
    
    }
    
    public function update(Request $request){

        $request->merge([
            'id' => 1,
            'name' => 'qeqwe',
            'email' => 'joel@mail.com'.time(),
            'hotel_id' => 1,
            'role_id' => 1,
            'password' => '123',
            'password_confirmation' => '123'
        ]); 
       
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'hotel_id' => 'sometimes|exists:hotels,id',
            'role_id' => 'sometimes|exists:roles,id',
            'password' => 'sometimes|confirmed'
        ]);

        if($validator->passes()){

            $user = User::find($request->id);
            
            if($request->has('password' && $request['password' != ''])){
                $request['password'] = Hash::make($request['password']);
            }
            
            if($user && $user->update($request->all())){
                
                LogController::store(Auth::user()->id, 'Actualizar', $user->id, 'Actualizo un usuario', 'users', FacadesRequest::getRequestUri().'/'.$user->email);
                // error_log($user);
                // return $user->hotel;       
                return back()->with('success', 'ok');
            }
            
        }
        LogController::store(Auth::user()->id, 'Error', 0, 'Error al actualizar un usuario', 'users', FacadesRequest::getRequestUri().'/'.$request->id);

        // return $validator->errors();
        
        return back()->withErrors($validator->errors());
    }

    public function destroy($id){

        $user = User::find($id);

        if($user){
            
            error_log($user->delete());

            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id
            ]);

        }

        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
    public function get($id){
    
        $user = User::find($id);

        if($user){
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 1,
                'data' => $user
            ]);
        }

        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
}
