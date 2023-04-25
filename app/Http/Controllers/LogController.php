<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public static function store($user_id, $action, $second_id, $description, $module, $route, $model = null)
    {
        if(isset($model)) error_log($action. ' >>' . json_encode($model));
        $log = new Log;
        $log->user_id = $user_id;
        $log->action = $action;
        $log->second_id = $second_id;
        $log->description = $description; 
        $log->module = $module;
        $log->route = $route; 
        $log->save();
    }
}
