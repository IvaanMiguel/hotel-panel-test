<?php

namespace App\Models;

use BaconQrCodeTest\Common\ReedSolomonTest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public static $types = ['debit', 'credit'];
   
    protected $fillable = [
        'name_card',
        'number',
        'cvv',
        'exp_month',
        'exp_year',
        'type_card',
        'client_id',
        'reservation_id'
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

 



}
