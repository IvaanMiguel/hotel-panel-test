<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_es', 'name_en', 'name_fr', 'description_es', 'description_en', 'description_fr', 'url_es', 'url_en', 'url_fr', 'cover', 'start_date', 'end_date', 'price', 'hotel_id', 'status',
    ];

    public function hotel()
    {
    	return $this->belongsTo(Hotel::class);
    }
}
