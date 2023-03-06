<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturationData extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'razon_social', 'document_type', 'document_number', 'address', 'zip_code', 'state', 'city', 'reservation_id', 'country_id',        'email',
        'tax_regime','tax_postal_code'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
