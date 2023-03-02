<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

        public function hotels()
    {
        return $this->belongsToMany(Hotel::class)->withPivot('max_people','base_people','extra_per_person');
    }
}
