<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Rate;
use Illuminate\Cache\Lock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use NunoMaduro\Collision\Adapters\Laravel\Exceptions\NotSupportedYetException;
use PHPUnit\Framework\Attributes\BackupGlobals;

use function Laravel\Prompts\error;

class RateController extends Controller
{
      public $breadcrumb_info = [
        'main_title' => 'Tarifas',
        'second_level' => '',
        'add_button' => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rates = Rate::get();
    
        $breadcrumb_info = $this->breadcrumb_info;
    
        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar tarifas', 'rates', request()->getUri());
        return view('rates.index', get_defined_vars());
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
    {/* 
        $request->merge([
            'name' => 'wqeqe',
            'description' => 'wewrwrwewr'
        ]); */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if($validator->passes()){

            if($rate = Rate::create($request->all())){


                LogController::store(Auth::user()->id, 'registrar', $rate->id, 'registrar una tarifa', 'rates', $request->url());                
                return back()->with('status', 'ok');
            }
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error a registrar una tarifa', 'rates', $request->url());
        return back()->withErrors($validator->errors());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rate = Rate::find($id);
        
        if($rate){

            $breadcrumb_info = $this->breadcrumb_info;
            
            LogController::store(Auth::user()->id, 'consultar', $id, 'cosultar una tarifa', 'rates', request()->url());
            return view('rates.show', get_defined_vars());
        }        

        LogController::store(Auth::user()->id, 'error', $id, 'error al consultar una tarifa', 'rates', request()->url());
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
            'id' => 2, 
            'name' => 'lorem asdad',
            'description' => 'weqe'
        ]); */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validator->passes()){

            $rate = Rate::find($request->id);
            error_log(json_encode($rate, JSON_PRETTY_PRINT));


            if($rate && $rate->update($request->all())){

                LogController::store(Auth::user()->id, 'actualizar', $rate->id, 'actualizar una tarifa', 'rates', $request->url());
                return back()->with('status', 'ok');

            }
            
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al actualizar una tarifa', 'rates', $request->url());
        return back()->withErrors($validator->errors());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rate = Rate::find($id);

        if($rate && $rate->delete()){
    
            LogController::store(Auth::user()->id, 'eliminar', $id, 'eliminar tarifas', 'rates', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar una tarifa', 'rates', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id 
        ]);
    }

    public function get($id){

        $rate = Rate::find($id);

        if($rate){

            return response()->json([
                'message' => 'Registro consultado correctamemte',
                'code' => 1,
                'data' => $rate
            ]);
        }

        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);

    }


}
