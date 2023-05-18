<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Card;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c = Card::create([
            'name_card' => 'Tarjeta Bamco de mexico',
            'number' => '1232-4435-2784',
            'cvv' => '045279893251446634',
            'month' => Carbon::now()->month,
            'year' => Carbon::now()->year,
            'type' => 'Credito',
            'used' => false,
            'reservation_id' => 1,
            'status' => true
        ]);
    }
}
