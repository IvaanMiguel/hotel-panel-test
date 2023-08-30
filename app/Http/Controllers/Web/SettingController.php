<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Image;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::first();

        LogController::store(Auth::user()->id, 'Consultar', 0, 'consultar configuracion', 'settings', FacadesRequest::getRequestUri());

        return view('settings.index', get_defined_vars());

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

    /*      $request->merge([
            "id" => 1,
            "google_recaptcha_public_key" => "UPDATED       6Lfi4noaAAAAAJNaei8RfLECHcdzwm6m_4HOGFaF",
            "google_recaptcha_private_key" => "UPDATED      6Lfi4noaAAAAAEo7FTjxsWUkJBpQxaAi6b7r05jZ",
            "production_stripe_private_key" => "UPDATED     demo",  
            "production_stripe_public_key" => "UPDATED      demo",
            "test_stripe_private_key" => "UPDATED          sk_test_51Gy3elHwK1JeYAVej9CEULpKUMjyUxOnVlmyWBR448axlWhxZNamRsl6hFMblWP8jXwepc8ZARIz7BBeSoq4dvrI00ARsPzXaj",
            "test_stripe_public_key" =>"UPDATED            pk_test_51Gy3elHwK1JeYAVen3EHRew1E0L5RvwDg5vzMH26I41PCrUQ3FCFRCXOzFkC2OsTdvgg8euqbBlG5DRkkJqO1lFz00YhrwRbOS",
            "production" => true,
            "email" => "UPDAsecrwn@mail.com",
            "usd_value" => "61.04",
            "eur_value" => "53.65"
        ]);  */

        $validator = Validator::make($request->all(), [
            "google_recaptcha_public_key" => "required",
            "google_recaptcha_private_key" => "required",
            "production_stripe_private_key" => "required",
            "production_stripe_public_key" => "required",
            "test_stripe_private_key" => "required",
            "test_stripe_public_key" =>"required",
            "production" => 'required|boolean',
            "email" => "required|email",
            "usd_value" => "decimal:2",
            "eur_value" => "decimal:2"
        ]);

        if($validator->passes()){

            if($setting = Setting::find($request->id)){

                if($setting->update($request->all())){

                    if($request->hasFile('cover')){

                        $file = $request->file('cover');

                        $name_file = "portada_".time().".".$file->getClientOriginalExtension();

                        $request->file('cover')->storeAs('public/settings/', $name_file); 

                        $original_cover = $setting->cover;

                        // return File::exists(public_path().'/storage/settings/'.$name_file);
                    
                        if($original_cover && File::exists(public_path().'/storage/settings/'.$original_cover->url)){
                            File::delete(public_path().'/storage/settings/'.$original_cover->url);
                        }
                        
                       if($original_cover){
                        
                            $original_cover->update(['url' => $name_file]);
                        }else{
                        
                            Image::create([
                                'url' => $name_file,
                                'type' => 'cover',
                                'imageable_type' => Setting::class,
                                'imageable_id' => $setting->id,
                            ]);
                        }
                
                    
                    }
                    // return $setting->cover;

                    LogController::store(Auth::user()->id, 'actualizar', $request->id, 'actualizar configuracion', 'settings', request()->url());
                    return back()->with('status', 'ok');
                }
            }
        }


        LogController::store(Auth::user()->id, 'error', $request->id, 'Error al actualizar confguracion', 'settings', request()->url());
        return back()->withErrors($validator->errors());
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get($id){
        
        $setting = Setting::find($id);

        if($setting){
            LogController::store(Auth::user()->id, 'consultar', $id, 'consultar configuracion', 'settings', request()->route());
            return response()->json([
                'message' => 'Registro consultado correctamente',
                'data' => $setting,
                'code' => 1
            ]);
        }


        LogController::store(Auth::user()->id, 'error', $id, 'error la consultar configuracion' ,'settings', request()->route());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'data' => $id,
            'code' => null
        ]);
    }
}
