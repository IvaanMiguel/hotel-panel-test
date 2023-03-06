<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_es', 'name_en', 'name_fr', 'description_es', 'description_en', 'description_fr', 'discount_es', 'discount_en', 'discount_fr', 'cover', 'start_date', 'end_date', 'hotel_id','status',
    ];

    public function rates()
    {
    	return $this->belongsToMany(Rate::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
