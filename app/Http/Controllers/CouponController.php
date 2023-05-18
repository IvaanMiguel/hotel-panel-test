<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        //
    }


    // monto de la reservacion con descuento
    public function get_amount_discount($request, $reservation, $reservation_rooms){
    
        // monto de la reservacion con descuento aplicado 
        $amount_discount = 0;

        $coupon = $this->validate_coupon($request->coupon_code, $reservation->check_in, $reservation->check_out, $request->nights_reserved, $reservation->amount, $reservation->room->hotel->id, $reservation->room->type->id, $reservation->rate_id);

        // si el cupon es válido
        
        if($coupon != false && !is_null($coupon)){

            //cupon rate promocion
            if($coupon->price_per_night != null){
                $amount_discount = $coupon->price_per_night * $request->nights_reserved;

                //ponerles el precio especial a cada noche
                foreach ($reservation_rooms as $key => $reservation_room) {
                    $reservation_room->final_amount = $coupon->price_per_night;
                }
            }

            //descuento en monto(porcentage o resata a total)
            if($coupon->amount != null){
                //get descuento
                if($coupon->is_percentage){
                    $amount_discount = $reservation->amount - (($reservation->amount * $coupon->amount) / 100);
                }else{
                    $amount_discount = $reservation->amount - $coupon->amount;
                }
            }

            $coupon->uses_count++;
            //relacionar con reserva
            $coupon->reservations()->attach($reservation->id, [
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $coupon->save();

            $reservation->load(['coupons']);

            return $amount_discount;
            
        }

        return false;

    }

    public static function validate_coupon($code, $start_date, $end_date, $nights, $amount, $hotel_id, $type_id, $rate_id){
        $coupon = Coupon::where('code',$code)
            ->where('status','activo')
            ->whereRaw('coupons.uses_count < coupons.limit_uses')
            ->whereDate('start_date','<=', $start_date)
            ->whereDate('end_date','>=',$end_date)
            ->with('types:id,name')
            ->first();

        if($coupon){


            // validar las noches (en caso de tener minimo de noches)
            if($coupon->min_nights != null && $nights < $coupon->min_nights){
                //return "no cumple con la cantidad de noches nesesarias";
                return false;
            }


            //validar monto(en caso de tener monto minimo)
            if($coupon->min_amount != null && $amount < $coupon->min_amount){
                //return "no cumple con el minimo monto requerido";
                return false;
            }

            //validar si aplica A un hotel
            if($coupon->hotel_id != null && $hotel_id != $coupon->hotel_id){
                //return "verificar si la reservacion es con esa tarifa";
                return false;
            }


            // ver su aplica a uno o mas tipos de habitaciones

            if($coupon->types != null){
                $type_ids = $coupon->types->pluck('id')->toArray();
                if(!in_array($type_id, $type_ids)){
                    //return "el cupon no aplica para este tipo de habitacion";
                    return false;
                }
            }

            //validar si aplica A una tarifa
            if($coupon->rate_id != null && $rate_id != $coupon->rate_id){
                //return "verificar si la reservacion es con esa tarifa";
                return false;
            }

            return $coupon;
        }

        return dd(false);

    }

}
