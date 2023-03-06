<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'stock', 'reserved', 'type_id', 'rate_id' , 'hotel_id', 'status'
    ];


    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function rates()
    {
    	return $this->belongsToMany(Rate::class)->withPivot('price','id');
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
