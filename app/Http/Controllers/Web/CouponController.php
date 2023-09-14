<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LogController;
use App\Models\Coupon;
use App\Models\CouponData;
use App\Models\Image;
use Carbon\CarbonPeriod;
use Illuminate\Auth\Events\Logout;
use Illuminate\Cache\Lock;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\TextUI\Configuration\LoggingNotConfiguredException;
use Ramsey\Uuid\Guid\Fields;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function PHPUnit\Framework\returnSelf;

class CouponController extends Controller
{
    public $breadcrumb_info = [
        'main_title' => 'Cupones',
        'second_level' => '',
        'add_button' => false
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::get();

        $breadcrumb_info = $this->breadcrumb_info;

        LogController::store(Auth::id(), 'consultar', 0, 'consultar hoteles', 'hotels', request()->url());
        return view('coupons.index', get_defined_vars());
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
     */#$##
    public function store(Request $request)
    {
/* 
         $request->merge([
            'name' => 'dia de los  sandias',
            'description' => '#hail 100cia :v',
            'code' => time(),
            'uses_count' => 1,
            'limit_uses' => 1000, 
            'hotel_id' => 1,
            'status' => 'active',
            'type_ids' => [1,2],

            // coupon data
            'amount' => 1000,
            'price_per_night' => 400,
            'is_percentage' => true,
            'min_nights' => 3,
            'exchange' => 'lorem :v',
            'min_amount' => 2300,
            'start_date' => Carbon::now()->addDays(5),
            'end_date' => Carbon::now()->addDays(5),
            
        ]);  */

        // + 'image' => {'archivo imagen'}
     
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'code' => 'required|unique:coupons,code',
            'uses_count' => 'sometimes|numeric|min:0',
            'limit_uses' => 'sometimes|numeric',
            'hotel_id' => 'required|exists:hotels,id',
            'image' => 'required|image',

            'type_ids.*' => 'sometimes|exists:types,id',
            
            // coupon data
            'amount' => 'sometimes|numeric',
            'price_per_night' => 'sometimes|numeric',
            'is_percentage' => 'sometimes|boolean',
            'min_nights' => 'sometimes|numeric|min:1',
            'exchange' => 'required',
            'min_amount' => 'sometimes|numeric|min:0',
            'start_date' => 'required|after:today',
            'end_date' => 'required|after_or_equal:start_date',
            'status' => 'required',
        ]);


        // existe otro cupon en ese mismo hotel, para ese tipo de habitacion, cuyas fechas estan en el mismo rango
        $coupons_same_vals = Coupon::whereNot('id', $request->id)->
                whereHas('coupon_data' , function ($q) use($request){
                    $q->where([
                            'hotel_id' => $request->hotel_id,     
                    ]);

                    $q->where(function($q) use ($request){
                        $q->where('start_date', '>=', $request->start_date)
                        ->where('end_date', '<', $request->start_date);
                    })->orWhere(function($q) use ($request){
                        $q->where('start_date', '<', $request->end_date)
                        ->where('end_date', '>=', $request->end_date);
                    });
                })
                ->whereHas('types', function($q) use ($request){
                    $q->where('type_id', $request->type_id);
                })
                // ->get();
                ->exists();

        if($coupons_same_vals){
            $validator->errors()->merge(['dates' => 'Hay otro cupon con esos datos']);
        }

        if($validator->errors()->isEmpty()){
            
            if($coupon = Coupon::create($request->all())){
                
                if($request->hasFile('image')){
                    
                    $file = $request->file('image');

                    $new_name = $coupon->code.'_coupon_'.$coupon->id.'_'.time().'.'.$file->getClientOriginalExtension();

                    $path = $request->file('image')->storeAs(
                        'public/coupons/',
                        $new_name
                    );

                    $image = Image::create([
                        'url' => $new_name,
                        'type' => 'cover',
                        'imageable_type' => Coupon::class,
                        'imageable_id' => $coupon->id
                    ]);

                    $request->merge(['coupon_id' => $coupon->id]);
                    $coupon_data = CouponData::create($request->all());

                    $coupon->types()->attach($request->type_ids);


                    // return $coupon;
                    LogController::store(Auth::id(), 'Crear', $coupon->id, 'agregar un cupon', 'coupons', request()->url());
                    return back()->with('status', 'ok');
                }
            }
        }


        // return $validator->errors()->all();

        LogController::store(Auth::id(),'error', 0, 'error al crear cupon', 'coupons', request()->url());
        return back()->withErrors($validator->errors());
    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $coupon = Coupon::with(['coupon_data'])->find($id);

        if($coupon){
            
            LogController::store(Auth::id(), 'consultar', $id, 'consultar un cupon', 'coupons', request()->url());
            return view('coupons.show', get_defined_vars());
        }

        LogController::store(Auth::id(), 'error', $id, 'error al consultar un cupon', 'coupons', request()->url());
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

      /*   $request->merge([
            'id' => 2,
            'name' => 'UPDATED',
            'description' => '#hail  :v',
            'code' => Coupon::find(2)->code,
            'uses_count' => 1,
            'limit_uses' => 1000, 
            'hotel_id' => 1,
            'status' => 'active',
            'type_ids' => [2],

            // coupon data
            'amount' => 1000,
            'price_per_night' => 400,
            'is_percentage' => true,
            'min_nights' => 3,
            'exchange' => 'lorem :vadasdassdsdasdasdasdasd',
            'min_amount' => 2300,
            'start_date' => '2023-09-17',
            'end_date' => '2023-09-19',
            
        ]); 
     */
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'code' => 'required|unique:coupons,code,'.$request->id,
            'uses_count' => 'sometimes|numeric|min:0',
            'limit_uses' => 'sometimes|numeric',
            'hotel_id' => 'required|exists:hotels,id',
            'image' => 'required|image',

            'type_ids.*' => 'sometimes|exists:types,id',
            
            // coupon data
            'amount' => 'sometimes|numeric',
            'price_per_night' => 'sometimes|numeric',
            'is_percentage' => 'sometimes|boolean',
            'min_nights' => 'sometimes|numeric|min:1',
            'exchange' => 'required',
            'min_amount' => 'sometimes|numeric|min:0',
            'start_date' => 'required|after:today',
            'end_date' => 'required|after_or_equal:start_date',
            'status' => 'required'
        ]);

  
        // existe otro cupon en ese mismo hotel, para ese tipo de habitacion, cuyas fechas estan en el mismo rango
        $coupons_same_vals = Coupon::whereNot('id', $request->id)->
            whereHas('coupon_data' , function ($q) use($request){
                $q->where([
                        'hotel_id' => $request->hotel_id,     
                ]);

                $q->where(function($q) use ($request){
                     $q->where('start_date', '>=', $request->start_date)
                     ->where('end_date', '<', $request->start_date);
                })->orWhere(function($q) use ($request){
                    $q->where('start_date', '<', $request->end_date)
                    ->where('end_date', '>=', $request->end_date);
                });
            })
             ->whereHas('types', function($q) use ($request){
                $q->where('type_id', $request->type_id);
            })
            // ->get();
            ->exists();

        if($coupons_same_vals){
            $validator->errors()->merge(['dates' => 'Hay otro cupon con esos datos']);
        }

        if($validator->errors()->isEmpty()){
            
            $coupon = Coupon::find($request->id);
            
            
            if($coupon && $coupon->update($request->all())){
            
                if($request->has('type_ids')) $coupon->types()->sync($request->type_ids);

                // return $coupon->types;

                $coupon_data = CouponData::updateOrCreate([
                    'coupon_id' => $request->id
                ],
                $request->all()
            );


                if($request->hasFile('image')){
                    
                    $original_cover = $coupon->images;

                    // $original_cover;
                    if($original_cover &&  File::exists(public_path().'/storage/coupons/'.$original_cover->url)){   
                        File::delete(public_path().'/storage/coupons/'.$original_cover->url);
                    }

                    if($original_cover){
                        $original_cover->delete();
                    }

                    // archivo subido

                    $file = $request->file('image');

                    $new_name = $coupon->code.'_coupon_'.$coupon->id.'_'.time().'.'.$file->getClientOriginalExtension();

                    $path = $request->file('image')->storeAs(
                        'public/coupons/',
                        $new_name
                    );

                    $image = Image::create([
                        'url' => $new_name,
                        'type' => 'cover',
                        'imageable_type' => Coupon::class,
                        'imageable_id' => $coupon->id
                    ]);  
                
                }

                LogController::store(Auth::id(), 'actualizar', $request->id, 'actualizar un cupon', 'coupons', request()->url());
                return back()->with('status', 'ok');
            }
        }

        LogController::store(Auth::id(), 'error', $request->id, 'Error al actluaizar un cupon', 'coupons', request()->url());
        return back()->withErrors($validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if($coupon){
            if($coupon->coupon_data){
                $coupon->coupon_data()->delete();
            }     
            $coupon->delete();
       
       
            LogController::store(Auth::id(), 'Eliminar', $id, 'Eliminar un cupon', 'coupons', request()->url());
            return response()->json([
                'message' => 'Registro eliminado correctamente',
                'code' => 1,
                'data' => $id
            ]);
       
        }

        LogController::store(Auth::id(), 'Error', $id, 'Error al eliminar un cupon', 'coupons', request()->url());
        return response()->json([
            'message' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

    public function get($id){
        
        $coupon = Coupon::with('coupon_data')->find($id);
    
        if($coupon){

            LogController::store(Auth::id(),'consultar', $id, 'cosultar un cupon', 'coupons', request()->url());           
            return response()->json([
                'message' => 'Registr consultado correctamente',
                'code' => 1,
                'data' => $coupon
            ]);
        }

        LogController::store(Auth::id(), 'error', $id, 'error al consultar un cupon', 'coupons', request()->url());
        return response()->json([
            'messaage' => 'Ha ocurrido un error',
            'code' => -1,
            'data' => $id
        ]);
    }

}
