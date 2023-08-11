<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class LogController extends Controller
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
    public static function store($user_id, $action, $second_id, $description, $module, $route)
    {
        $log = new Log();
        $log->user_id = $user_id;
        $log->action = $action;
        $log->second_id = $second_id;
        $log->description = $description;
        $log->module = $module;
        $log->route = $route;
        error_log(json_encode($log));
        $log->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        //
    }
}
