<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_es', 
        'title_en', 
        'title_fr', 
        'description_es',
        'description_en',
        'description_fr',
        'status',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class)->withPivot('count');
    }
}
