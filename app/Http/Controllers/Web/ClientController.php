<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Client;
use App\Models\Country;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

use function Laravel\Prompts\error;

class ClientController extends Controller
{

    
    public $breadcrumb_info = [
        "main_title" => "Clientes",
        "second_level" => "",
        "add_button" => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $clients = Client::with('country')       
        ->orderBy('created_at','DESC')
        ->get();

        $clients_by_countries = Country::has('clients')->withCount('clients')->get();

        $countries = Country::all();

        LogController::store(Auth::user()->id, 'Cosultar', 0, 'Consutar todos los usuarios', 'users', FacadesRequest::getRequestUri());

        // return $clients_by_countries;

        return view('clients.index', get_defined_vars());        

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

   /*      $request->merge([
            'name' => 'jeol',
            'email' => 'jolle@golamil.com',
            'phone_number' => '1231231323',
            'password' => '23453412',
            'password_confirmation' => '23453412',
            'country_id' => '1'
        ]); */
    
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:clients,email',
            'phone_number' => 'required',
            'password' => 'required|confirmed',
            'country_id' => 'required|exists:countries,id'

        ]);

       if($validator->passes()){

           $request['password'] = Hash::make($request['password']);
           // return $request->all();
           $client = Client::create($request->all());
           
           LogController::store(Auth::user()->id, 'Crear', $client->id, 'Crear un nuevo cliente', 'clients', FacadesRequest::getRequestUri());
        
           return back()->with('success', 'ok');
        }

        LogController::store(Auth::user()->id, 'Error', 0, 'Error al crear cliente', 'clients', FacadesRequest::getRequestUri());
        return back()->withErrors($validator->errors());
        
    }

    /**
     * Display the specified resource.
     */
    public function show($email = null)
    {
    
        $breadcrumb_info = $this->breadcrumb_info;
        $breadcrumb_info['second_level'] = 'Detalles de cliente';
        $breadcrumb_info['abb_button'] = false;

        $client = Client::where('email', $email)
            ->with('country')
            ->first();
    // falta traer reservaciones, el no esta todavia
        
        $countries = Country::all();

        // TODO: Obtener cuantas veces se ha quedado en cada hotel

        if($client){

            LogController::store(Auth::user()->id, 'Consultar', $client->id, 'Consultar un cliente', 'clients', FacadesRequest::getRequestUri());
            return view('clients.show', get_defined_vars());
        }
        LogController::store(Auth::user()->id, 'Error', 0, 'No se encontro al cliente', 'clients', FacadesRequest::getRequestUri());
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


      /*    $request->merge([
            'id' => 3,
            'name' => 'jeol',
            'email' => 'jolle@golamil.com',
            'phone_number' => '1231231323',
            'password' => '23453412',
            'password_confirmation' => '23453412',
            'country_id' => '2'
        ]); */
        $client = Client::find($request->id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:clients,email,'.$request->id,
            'phone_number' => 'required',
            'password' => 'required|confirmed',
            'country_id' => 'required|exists:countries,id'
        ]);
        if ($validator->passes()){

            $client = Client::find($request->id);

            if($client && $client->update($request->all())){
                LogController::store(Auth::user()->id, 'Actualizar' ,$client->id, 'Actualizar cliente', 'clients', FacadesRequest::getRequestUri());
        
                return back()->with('success','ok');
            }
        }
        
        LogController::store(Auth::user()->id, 'Error', 0, 'Error al actualizar un cliente', 'clients', FacadesRequest::getRequestUri());
    
        return back()->withErrors($validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        
        $client = Client::find($id);
     
        if($client){
            LogController::store(Auth::user()->id, 'Eliminar',$id ,'Elimino un cliente', 'users', request()->url().'/'.$client->email);
            $client->delete();

            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id 
            ]);
        }

        LogController::store(Auth::user()->id, 'Error', $id, 'Ha ourrido un error', 'users', request()->url().'/'.$id);
       
        return response()->json([
          'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id 
        ], 404);
      
    }
    
    public function get($id){
        $client = Client::with('country')
                        ->find($id);

        if($client){

            LogController::store(Auth::user()->id, 'Obtener', $id, 'obtener un cliente', 'clients', request()->url());
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'code' => 1,
                'data' => $client
            ]);
        }

        LogController::store(Auth::user()->id, 'Error', $id, 'Error al obtener cliente', 'clients', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
 
}
