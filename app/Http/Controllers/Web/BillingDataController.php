<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\BillingData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class BillingDataController extends Controller
{
    public $breadcrumb_info = [
        "main_title" => "Tarjetas",
        "second_level" => "",
        "add_button" => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $breadcrumb_info = $this->breadcrumb_info;
       $billing_data = BillingData::get();

       LogController::store(Auth::user()->id, 'consultar', 0, 'consultar datos de facturación', 'billing-data', $request->url());
       return view('billing-data.index', get_defined_vars());

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
      /*    $request->merge([
            'razon_social' => 'qwe',
            'document_type' => 'qwe',
            'document_number' => 'qwe',
            'address' => 'qwe',
            'zip_code' => 'qwe', 
            'state' => 'qwe', 
            'city' => 'qwe', 
            'reservation_id' => 1, 
            'country_id' => 1,
            'email' => 'qwe', 
            'tax_regime' => 'qweqe', 
            'tax_postal_code' => 'qweqwe',
            'user_id' => 2,
            // 'uso_cfdi_id' => 1
        ]);  */
        $validator = Validator::make($request->all(), [
            'razon_social' => 'required',
            'document_type' => 'required',
            'document_number' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'city' => 'required',
            'reservation_id' => 'required|exists:reservations,id',
            'country_id' => 'required|exists:countries,id',
            'email' => 'required',
            'tax_regime' => 'required',
            'tax_postal_code' => 'required',
            'uso_cfdi_id' => 'sometimes|exists:uso_cfdis,id',
            'user_id' => 'required|exists:users,id'
        ]);

        if($validator->passes()){
            
            if($billing_data = BillingData::create($request->all())){

                LogController::store(Auth()->user()->id, 'registrar', $billing_data->id, 'registrar datos de facturacion', 'billing_data', $request->url());
                // error_log(json_encode($billing_data, JSON_PRETTY_PRINT));
                return back()->with('status', 'ok');
                
            }

        }

        LogController::store(Auth()->user()->id, 'error', 0, 'error al registrar datos de facturacion', 'biling_data', $request->url());
        // error_log(json_encode($validator->errors()->all(), JSON_PRETTY_PRINT));
        return back()->withErrors($validator->errors());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $breadcrumb_info = $this->breadcrumb_info;
        $breadcrumb_info['second_level'] = 'Detalles';

        $billing_data = BillingData::find($id);
        if($billing_data){
            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar datos de facturacion', 'billing_data', request()->url());
            return view('billing-data.show', get_defined_vars());
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al cosultar datos de facturacion', 'billing_data', request()->url());
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
     /*  $request->merge([
            'id' => 2,
            'razon_social' => 'qwe UPDATED ',
            'document_type' => 'qwe UPDATED',
            'document_number' => 'qwe UPDATED',
            'address' => 'qwe UPDATED',
            'zip_code' => 'qwe UPDATED',  
            'state' => 'qwe UPDATED', 
            'city' => 'qwe UPDATED', 
            'reservation_id' => 1, 
            'country_id' => 1,
            'email' => 'qwe', 
            'tax_regime' => 'qweqe UPDATED', 
            'tax_postal_code' => 'qweqwe UPDATED',
            // 'uso_cfdi_id' => 1
        ]); */ 
        $validator = Validator::make($request->all(), [
            'razon_social' => 'required',
            'document_type' => 'required',
            'document_number' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            'state' => 'required',
            'city' => 'required',
            'reservation_id' => 'required|exists:reservations,id',
            'country_id' => 'required|exists:countries,id',
            'email' => 'required',
            'tax_regime' => 'required',
            'tax_postal_code' => 'required',
            'uso_cfdi_id' => 'sometimes|exists:uso_cfdis,id'
        ]);

        if($validator->passes()){

            $billing_data = BillingData::find($request->id);
            // error_log(json_encode($billing_data, JSON_PRETTY_PRINT));
            if($billing_data && $billing_data->update($request->all())){
                
                // error_log(json_encode($billing_data, JSON_PRETTY_PRINT));
                LogController::store(Auth::user()->id, 'actualizar', $billing_data->id, 'actualizar datos de facturacion', 'billing_data', $request->url());     
                return back()->with('status', 'ok');
            }
        }

        LogController::store(Auth::user()->id, 'error', $request->id, 'error al actualizar datos de facturacion', 'billing_data', $request->url());
        return back()->withErrors($validator->errors());
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $billing_data = BillingData::find($id);

        if($billing_data && $billing_data->delete()){

            LogController::store(Auth::user()->id, 'eliminar', $id, 'eliminar datos de facturacion', 'billing_data', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamente', 
                'code' => 1,
                'data' => $id
            ]);
        }

        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar datos de facturacion', 'billing_data', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function get($id){
        
        $billing_data = BillingData::find($id);

        if($billing_data){
            return response()->json([
                'message' => 'Registro consultado correctemente',
                'code' => 1,
                'data' => $billing_data
            ]);
        }

        return response()->json([
            'message' => 'Ha ocurrido un error', 
            'code' => -1,
            'data' => $id
        ]);
    }
}
