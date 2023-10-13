<?php

namespace App\Helpers;

use App\Models\Contact;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class Helper{

    public static function get_current_branch_pending_contacts(){
        
        $pending_contact_count = Contact::when(!is_null(Auth::user()->hotel_id), function($q){
            $q->where('hotel_id', Auth::user()->hotel_id);
        })->where('status', 'pendiente')
        ->count();
    
        return $pending_contact_count;
    }

    public function get_current_pending_reservations(){
        $pending_reservations_count = Reservation::when(!is_null(Auth::user()->hotel_id), function($q){
            $q->whereHas('room.hotel', function($q){
                $q->where('id', Auth::user()->hotel_id);
            });
        })->where('status', 'pendiente')->pluck('id');
        return $pending_reservations_count;
    }

    public function get_unique_reservation_code(){
        return ReservationService::unique_code('code');
    }
}
