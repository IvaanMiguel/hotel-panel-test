<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //cheac si el usuario es admin(o de sistemas)
    public static function isAdmin()
    {
        return (Auth::user()->role->name == "Director" ||
                Auth::user()->role->name == "Administrador" ||
                Auth::user()->role->name == "Sistemas");      
    }
}
