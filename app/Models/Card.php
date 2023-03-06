<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_card', 'number', 'cvv', 'month', 'year', 'type', 'used', 'reservation_id', 'status',
    ];

    public function reservation()
    {
    	return $this->belongsTo(Reservation::class);
    }
}
