<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(){

        $widgets = $this->get_widgets();

        return view('dashboard', get_defined_vars());
    }


    public function get_widgets(){

        $most_reserved_hotel_current_year = Hotel::withCount(['reservations as current_year_reservation_count' => function($q){
                                                $q->whereBetween('reservations.created_at', 
                                                                    [Carbon::now()->startOfYear(), Carbon::now()
                                                                ]);
                                                }])
                                                ->orderBy('current_year_reservation_count', 'DESC')
                                                ->first();


        $most_reserved_room_type_current_year = Room::withCount(['reservations as current_year_reservation_count' => function($q){
                                                $q->whereBetween('reservations.created_at', 
                                                                    [Carbon::now()->startOfYear(), Carbon::now()
                                                                ]);
                                                }])->orderBy('current_year_reservation_count', 'DESC')
                                                ->first();
        $last_month_revenue = 0;
        $last_year_revenur = 0;

        return collect([
            'most_reserved_hotel_current_year' => $most_reserved_hotel_current_year, 
            'most_reserved_room_tpe_current_year' => $most_reserved_room_type_current_year,
            'last_month_revenue' => $last_month_revenue,
            'last_year_revenue' => $last_year_revenur
        ]);
    }
}
