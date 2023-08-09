<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public $breadcrum_info = array(
        "main_title" => "Clientes",
        "second_level" => "",
        "add_button" => false
      );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('country')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $clients_by_country = Client::with('country')
                    ->groupBy('contry.name')
                    ->get();
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
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
