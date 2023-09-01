<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use App\Models\Card;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
     
    public $breadcrumb_info = [
        "main_title" => "Tarjetas",
        "second_level" => "",
        "add_button" => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb_info = $this->breadcrumb_info;

        $cards = Card::get();

        LogController::store(Auth::user()->id, 'consultar', 0, 'consultar tarjetas', 'cards', request()->url());

        return view('cards.index', get_defined_vars());
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
            'name_card' => 'test',
            'number' => time(),
            'cvv' => time(),
            'exp_month' => Carbon::now()->addMonth()->month,
            'exp_year' => Carbon::now()->addYear()->year,
            'type_card' => Card::$types[rand(0, count(Card::$types)-1)],
            'client_id' => rand(1,2)
        ]);

 */
        $validator = Validator::make($request->all(), [
            'name_card' => 'required',
            'number' => 'required',
            'cvv' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'type_card' => 'required|in:'.implode(',', Card::$types),
            'client_id' => 'required|exists:clients,id',
       ]);


       if($validator->passes()){
            if($card = Card::create($request->all())){
                // return $card;
                LogController::store(Auth::user()->id, 'registrar', $card->id, 'registrar una tarjeta', 'cards', request()->url());
                return back()->with('status', 'ok');
            }
       }
   
       LogController::store(Auth::user()->id, 'error', 0, 'error al registrar una tarjeta', 'cards', request()->url());
       return back()->withErrors($validator->errors());
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
/*         $request->merge([
            'id' => 1,
            'name_card' => 'test',
            'number' => time(),
            'cvv' => time(),
            'exp_month' => Carbon::now()->addMonth()->month,
            'exp_year' => Carbon::now()->addYear()->year,
            'type_card' => Card::$types[rand(0, count(Card::$types)-1)],
            'client_id' => rand(1,2)
        ]);
 */

        $validator = Validator::make($request->all(), [
            'name_card' => 'required',
            'number' => 'required',
            'cvv' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'type_card' => 'required|in:'.implode(',', Card::$types),
            'client_id' => 'required|exists:clients,id',
       ]);


       if($validator->passes()){

            $card = Card::find($request->id);

            if($card && $card->update($request->all())){


                return back()->with('status', 'ok');
            }
       }

       return back()->withErrors($validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $card = Card::find($id);

        if($card && $card->delete()){

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
}
