<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingData extends Model
{
    use HasFactory;

    protected $fillable = [
        'razon_social',
        'document_type',
        'document_number',
        'address',
        'zip_code',
        'state',
        'city',
        'reservation_id',
        'country_id',
        'uso_cfdi_id',
        'email',
        'tax_regime',
        'tax_postal_code'
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function uso_cfdi(){
        return $this->belongsTo(UsoCfdi::class);
    }


}
