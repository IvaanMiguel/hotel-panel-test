<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Image;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator as ValidationValidator;
use Spatie\Backtrace\Arguments\ReduceArgumentsAction;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\error;

class UserController extends Controller
{
    public $breadcrum_info = array(
        "main_title" => "Usuarios",
        "second_level" => "",
        "add_button" => false
    );
 

    public function index(){
        
        $breadcrum_info = $this->breadcrum_info;

        $users = User::when(!is_null(Auth::user()->hotel_id), function($q){
            $q->where('hotel_id', Auth::user()->hotel_id);
        })/* ->whereHas('roles', function($q){
            $q->where('name', 'Sistemas')
        }) */
        ->get();

        $roles = Role::all();

        LogController::store(Auth::user()->id, 'Consultar', 0, 'Consultar todos los usuarios', 'users', FacadesRequest::getRequestUri());
    
        return view('users.index', get_defined_vars());
   }
/*tinker >>  (new App\Http\Controllers\Web\UserController)->store((new Illuminate\Http\Request)->merge(['name' => 'joel', 'email' => 'test@tet.com', 'password' => '123', 'password_confirmation' => '123'])) */
   public function store(Request $request){
/*  
    $request->merge([
            'name' => 'qeqwe',
            'email' => 'joel@mail.com'.time(),
            'hotel_id' => 1,
            'role_id' => 1,
            'password' => '123',
            'password_confirmation' => '123'
        ]);  */
        // + 'avatar' => {archivo avatar}
      

        $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|confirmed',
                'hotel_id' => 'sometimes|exists:hotels,id',
                'role_id' => 'sometimes|exists:roles,id',
                'avatar' => 'sometimes|image'
            ]);
        

        if($validator->passes()){

            $request['password'] = Hash::make($request['password']);
            
            $user = User::create($request->all());
            
            if($request->has('role_id')){
                $user->assignRole($request->role_id);
            }

            if($request->hasFile('avatar')){

                $file = $request->file('avatar');
                
                $name_file = $user->name.'_'.time().'_avatar.'.$file->getClientOriginalExtension();

                $path = $request->file('avatar')->storeAs(
                    'public/users/',
                    $name_file
                );

                $image = Image::create([
                    'url' => $name_file,
                    'type' => 'avatar',
                    'imageable_type' => User::class,
                    'imageable_id' => $user->id,
    
                ]);
           
            }
    
            LogController::store(Auth::user()->id, 'Registrar', $user->id, 'registro de un nuevo usuario','users',FacadesRequest::getRequestUri());
            return back()->with('success', 'ok');
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'Ha ocurrido un error', 'users', FacadesRequest::getRequestUri());
        return back()->withErrors($validator->errors());

    }

    public function show($id = null){
        
   
        $breadcrum_info = $this->breadcrum_info;
        $breadcrum_info['second_level'] = 'Perfil de usuario';
        $breadcrum_info['add_buttin'] = false;
        
        if(is_null($id)){
            $email = Auth::user()->id;
        }

        
        $user = User::find($id);

        if($user){

            LogController::store(Auth::user()->id, 'Consultar', $user->id, 'consultar un usuario', 'users', FacadesRequest::getRequestUri());

            return view('users.profile', get_defined_vars());
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'No se encuentra el usuario', 'users',FacadesRequest::getRequestUri());

        return back()->with('status', 'error');
    
    }
    
    public function update(Request $request){

    /*     $request->merge([
            'id' => 49,
            'name' => 'qeqwe',
            'email' => 'joel@mail.com'.time(),
            'hotel_id' => 1,
            'role_id' => 1,
            'password' => '123',
            'password_confirmation' => '123'
        ]);  */
            // + 'avatar' => {archivo avatar}
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->id,
            'hotel_id' => 'sometimes|exists:hotels,id',
            'role_id' => 'sometimes|exists:roles,id',
            'password' => 'sometimes|confirmed',
            'avatar' => 'sometimes|image'
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
                if($request->hasFile('avatar')){

                    $avatar_anterior = $user->avatar();

                    if($avatar_anterior){
                     // delete   
                        if(File::exists(public_path().'/storage/users/'.$avatar_anterior->url)){
                            File::delete(public_path().'/storage/users/'.$avatar_anterior->url);
                        }

                        $avatar_anterior->delete();
                    }

                    $file = $request->file('avatar');

                    $name_file = $user->name.'_'.time().'_avatar.'.$file->getClientOriginalExtension();

                    $path = $request->file('avatar')->storeAs(
                        'public/users/',
                        $name_file
                    ); 

                  
                    $image = Image::create([
                        'url' => $name_file,
                        'type' => 'avatar',
                        'imageable_type' => User::class,
                        'imageable_id' => $user->id,
                    ]); 
                }
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
            
            $user->delete();

            LogController::store(Auth::user()->id, 'eliminar', $id, 'eliminar un usuario', 'users', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id
            ]);

        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al emimiar un usuario', 'users', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
    public function get($id){
    
        $user = User::find($id);

        if($user){

            LogController::store(Auth::user()->id, 'consulrar', $id, 'consultar un usuario', 'users', request()->url());
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 1,
                'data' => $user
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al consultar un usuario', 'users', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function recover_email(Request $request){
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        // $token = Hash::make(uniqid())
        if($user){
            $status =  Password::sendResetLink($request->only('email'));

            if($status == Password::RESET_LINK_SENT) {
                // error_log('ok');
                return redirect()->back()->with('success', 'ok');
            }
        }

        // error_log('error');
        return redirect()->back()->with('status', 'error');

        
    }

     public function password_update(Request $request){

        // return $request->all();
    
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function(User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                // error_log('updated');
                $user->save();
            }
        );


        
        // error_log($status); 
        return ($status == Password::PASSWORD_RESET) ?
                                        redirect()->back()->with('status', 'ok'): 
                                        redirect()->back()->with('status', 'error');
                                
    }

}
