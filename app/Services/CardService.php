<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CardService{


    public function disable(Collection $cards){
        echo("\n");
        echo "._____________."."\n";
        echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";

        $count = 0;

        foreach($cards as $card){

            $card->update([
                'name_card' => '000000000',
                'number' => '000000000',
                'cvv' => '000000000',
                'month' => '000000000',
                'year' => '000000000',
                'type' => '000000000',
                'used' => true
            ]);

            $count++;
        }

            echo "total de tarjetas removidas: ".$count." "."\n";

            echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";
            echo "._____________."."\n";
            echo("\n");
    }
}