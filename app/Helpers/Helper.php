<?php

namespace App\Helpers;

use App\Models\Contact;
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
}
