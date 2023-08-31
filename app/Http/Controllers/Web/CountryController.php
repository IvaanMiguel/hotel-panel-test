<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Country;
use Illuminate\Cache\RedisStore;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\FlareClient\Http\Response as HttpResponse;

class CountryController extends Controller
{
    public $breadcrumb_info = [
        'main_title' => 'Paises',
        'second_level' => '',
        'add_button' => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::get();

        $breadcrumb_info = $this->breadcrumb_info;

        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar todos los paises', 'countries', request()->url());
        
        return view('countries.index', get_defined_vars());
        
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
   /*       $request->merge([
            'name' => 'ciina',
            'code' => 'cn'.time()
        ]);  */

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:countries,code'
        ]);

        if($validator->passes()){
            
            if($country = Country::create($request->all())){
                // error_log('creado');

                LogController::store(Auth::user()->id, 'crear', $country->id, 'crear un pais', 'countries', request()->url());
                return back()->with('success', 'ok');
            }
        }
        
        // return $validator->errors();
        LogController::store(Auth::user()->id, 'error', 0, 'error al crear un pais', 'countries', request()->url());
        return back()->withErrors($validator->errors());  
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $country = Country::find($id);

        if($country){
            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar un pais', 'countries', request()->url());
            return view('countries.show', get_defined_vars());
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al consultar un pais', 'countries', request()->url());
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
    /*     $request->merge([
            'id' => 2,
            'name' => 'EUA',
            'code' => 'UPD'
        ]);  */

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:countries,code,'.$request->id
        ]);

        if($validator->passes()){

            $country = Country::find($request->id);

            if($country && $country->update($request->all())){

                LogController::store(Auth::user()->id, 'actualizar', $country->id, 'actualizar un pais', 'countries', request()->url());
                return back()->with('status', 'ok');
            }
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al actualizar un pais', 'countries', request()->url());
        return back()->withErrors($validator->errors());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $country = Country::find($id);

        if($country && $country->delete()){

            LogController::store(Auth::user()->id, 'eliminar', $id, 'eliminar un pais', 'countries', request()->url());

            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id
            ]);

        }

    
        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar un pais', 'countries', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function get($id){

        $country = Country::find($id);

        if($country){
            
            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar un pais', 'countries', request()->url());

            return response()->json([
                'message' => 'Registro cosultado correctamente',
                'code' => 1,
                'data' => $country
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al consultar un pais', 'countries', request()->url());

        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);

    }
}
