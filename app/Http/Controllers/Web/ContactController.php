<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PHPUnit\TextUI\Configuration\LoggingNotConfiguredException;

class ContactController extends Controller
{
    public $breadcrumb_info = [
        "main_title" => "Contactos",
        "second_level" => "",
        "add_button" => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with('hotel')->get();
        
        $breadcrumb_info = $this->breadcrumb_info;

        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar contactos', 'contacts', request()->url());

        return view('contacts.index', get_defined_vars());
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
/* 
        $request->merge([
            'message' => 'test',
            'hotel_id' => 2,
            'client_id' => 1
        ]); */

        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'client_id' => 'required|exists:clients,id',
            'status' => 'sometimes|in:'.implode(',',Contact::$status)
        ]);

        if($validator->passes()){

            if($contact = Contact::create($request->all())){

                LogController::store(Auth::user()->id, 'registrar', $contact->id, 'regiatrar un nuevo contacto', 'contacts', request()->url());

                return back()->with('status', 'ok');
            }
        }

        LogController::store(Auth::user()->id, 'error', 0, 'error al crear contacto', 'contacts', request()->url());

        return back()->withErrors($validator->errors());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::with('client', 'answers')->find($id);

        $breadcrumb_info = $this->breadcrumb_info;

        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar contactos', 'contacts', request()->url());

        return view('contacts.details', get_defined_vars());   
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
            'id' => 1,
            'message' => 'UPDATED TEST',
            'response' => 'UPDATED RESPONSE', 
            'hotel_id' => 1,
            'client_id' => 2,
            'status' => 'atendido'
        ]);
 */

        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'hotel_id' => 'required|exists:hotels,id',
            'client_id' => 'required|exists:clients,id',
            'status' => 'in:'.implode(',',Contact::$status)
        ]);
   
        if($validator->passes()){
            $contact = Contact::find($request->id);

            if($contact && $contact->update($request->all())){
                
                LogController::store(Auth::user()->id, 'actualizar', $request->id, 'actualizar un contacto', 'contacts', request()->url());
            
                // return $contact;

                return back()->with('status', 'ok');
            }
        }
   
        LogController::store(Auth::user()->id, 'error', 0, 'error al actualiar un contacto', 'contacts',request()->url());
       
        return back()->withErrors($validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if($contact && $contact->delete()){
            LogController::store(Auth::user()->id, 'eliminar', $id, 'eliminar un contacto', 'contacts', request()->url());
     
            return response()->json([
                'message' => 'Registro eliminado correctamente', 
                'code' => 1,
                'data' => $id
            ]);
        }


        LogController::store(Auth::user()->id, 'error', $id, 'error al eliminar contacto', 'contacts', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function get($id){
    
        $contact = Contact::find($id);

        if($contact){
            
            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar un contacto', 'contacts', request()->url());
            
            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $contact
            ]);
        }
        
        LogController::store(Auth::user()->id, 'error', $id, 'error al consultar un contacto', 'contacts', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }
}
