<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\Helpers;
use App\Mail\RecoverPasswordEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'hotel_id',
        'role_id',
        'dark_mode'
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
        'password' => 'hashed',
    ];

    protected $appends = [
        'avatar_path'
    ];

    public function getIsAdminAttribute(){
        return $this->roles()->whereIn('name', 
        [
            'Director', 
            'Administrador',
            'Sistemas',
        ])->exists();
    }

    public function isPublicador(){
        return $this->roles()->whereIn('name', ['Publicador'])->exists();
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function sendPasswordResetNotification($token){
        Mail::to($this->email)->send(new RecoverPasswordEmail($token, $this->email));
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function avatar(){
        return $this->images()->where('type', 'avatar')->first();
    }

    public function getAvatarPathAttribute(){
        return $this->avatar()? 
            URL::to('/storage/users/'. $this->avatar()->url): 
            null;
    }

    public function logs(){
        return $this->hasMany(Log::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}
