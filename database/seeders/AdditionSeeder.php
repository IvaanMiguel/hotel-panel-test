<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Addition;
class AdditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addition = new Addition();
        $addition->name_es = "Botella de agua";
        $addition->short_name_es = "Agua";
        $addition->description_es = "¿Le gustaría una botella de agua?";
        $addition->help_es = "Botella de agua purificada de 1 litro";

        $addition->name_en = "Bottle of water";
        $addition->short_name_en = "Water";
        $addition->description_en = "Would you like a bottle of water?";
        $addition->help_en = "1 liter purified water bottle";

        $addition->name_fr = "Bouteille d'eau";
        $addition->short_name_fr = "Eau";
        $addition->description_fr = "Désirez-vous une bouteille d'eau?";
        $addition->help_fr = "Bouteille d'eau purifiée de 1 litre";

        $addition->price = 20;
        $addition->cover = "cover.jpg";
        $addition->hotel_id = 1;
        $addition->status = "activo";

        $addition->save();

        $addition = new Addition();
        $addition->name_es = "Botella de agua";
        $addition->short_name_es = "Agua";
        $addition->description_es = "¿Le gustaría una botella de agua?";
        $addition->help_es = "Botella de agua purificada de 1 litro";

        $addition->name_en = "Bottle of water";
        $addition->short_name_en = "Water";
        $addition->description_en = "Would you like a bottle of water?";
        $addition->help_en = "1 liter purified water bottle";

        $addition->name_fr = "Bouteille d'eau";
        $addition->short_name_fr = "Eau";
        $addition->description_fr = "Désirez-vous une bouteille d'eau?";
        $addition->help_fr = "Bouteille d'eau purifiée de 1 litre";

        $addition->price = 25;
        $addition->cover = "cover.jpg";
        $addition->hotel_id = 2;
        $addition->status = "activo";

        $addition->save();

        $addition = new Addition();
        $addition->name_es = "Botella de agua";
        $addition->short_name_es = "Agua";
        $addition->description_es = "¿Le gustaría una botella de agua?";
        $addition->help_es = "Botella de agua purificada de 1 litro";

        $addition->name_en = "Bottle of water";
        $addition->short_name_en = "Water";
        $addition->description_en = "Would you like a bottle of water?";
        $addition->help_en = "1 liter purified water bottle";

        $addition->name_fr = "Bouteille d'eau";
        $addition->short_name_fr = "Eau";
        $addition->description_fr = "Désirez-vous une bouteille d'eau?";
        $addition->help_fr = "Bouteille d'eau purifiée de 1 litre";

        $addition->price = 25;
        $addition->cover = "cover.jpg";
        $addition->hotel_id = 3;
        $addition->status = "activo";

        $addition->save();
 
    }
}
