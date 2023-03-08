<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
class EventController extends Controller
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
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }


     ///proceso inactivar eventos con 7 días de antiguedad
    public static function update_status($status){
        echo "._____________."."\n";
        echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";

        $events = Event::where('status', 'activo')
                ->where('end_date', '<', Carbon::now()->subDays(7))
                ->get();

        foreach($events as $event){
            $event->status = $status;
            $event->save();
            echo $event->name_es." : ".$event->status."\n";
        }

        echo "._____________."."\n";
    }
}
