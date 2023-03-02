<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;


    protected $fillable = [
        'name_es', 'name_en', 'name_fr', 'description_es', 'description_en', 'description_fr', 'url_es', 'url_en', 'url_fr', 'cover', 'status',
    ];

/*     public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    } */

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class);
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
