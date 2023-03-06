<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'message', 'response', 'hotel_id', 'client_id', 'status',
    ];

    public function client()
    {
    	return $this->belongsTo(Client::class);
    }

    public function hotel()
    {
    	return $this->belongsTo(Hotel::class);
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
