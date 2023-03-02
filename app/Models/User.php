<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'role_id', 'password', 'hotel_id', 'status',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function role()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    //cheac si el usuario es admin(o de sistemas)
    public static function isAdmin()
    {
        if(Auth::user()->role->name == "Director" || Auth::user()->role->name == "Administrador" || Auth::user()->role->name == "Sistemas"){
            return true;
        }
        return false;
    }
}
