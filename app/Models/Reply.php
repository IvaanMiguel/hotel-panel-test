<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'observations', 
        'questionnaire_id',
        'reservation_id',
        'status',
    ];

    public function questionnaire()
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
