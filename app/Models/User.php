<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'role_id', 'extra_per_person', 'default_price', 'hotel_id', 'type_id', 'status',
    ];

    public function hotel()
    {
    	return $this->belongsTo(Hotel::class);
    }

    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
    
}
