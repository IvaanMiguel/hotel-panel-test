<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filable extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'filable_type',
        'filable_id'
    ];

    public function file(){
        return $this->belongsTo(File::class);
    }
}

