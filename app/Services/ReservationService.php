<?php 

namespace App\Services;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationService{

    static $model = Reservation::class;

    public static function unique_code($field, $model = null){
        $reservation_codes = $model ?? static::$model::pluck($field);
        do{
            $code = uniqid();
        }while($reservation_codes->contains($code));
        return $code;
    }

}