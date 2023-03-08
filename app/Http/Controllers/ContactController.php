<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ContactController extends Controller
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
    public function show(contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contact $contact)
    {
        //
    }

    public static function update_status($status){
        echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";
        $contacts = Contact::where('status','pendiente')
        ->where('created_at', '<', Carbon::now()->subDays(40))->get();

        foreach($contacts as $contact){
            $contact->status = $status;
            $contact->save();
            echo 'id: '.$contact->id. ' '.$contact->created_at.'   :   '.$contact->status."\n";
        }
    }
}
