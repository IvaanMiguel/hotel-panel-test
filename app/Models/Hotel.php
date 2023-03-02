<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HotelImage;

class Hotel extends Model
{
    use HasFactory;


    public function images(){
        return $this->hasMany(HotelImage::class);
    }


    protected $fillable = [
        'name', 'address', 'phone_number', 'cover', 'email', 'url_address', 'slug', 'status',
    ];

    public function users()
    {
    	return $this->hasMany(User::class);
    }

 /*    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class)->withPivot('max_people','base_people','extra_per_person');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }

    public function additions()
    {
        return $this->hasMany(Addition::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'hotel_activity');
    } */
}
