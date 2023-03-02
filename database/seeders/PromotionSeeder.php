<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotion = new Promotion();
        $promotion->name_es = "Promoción 1";
        $promotion->name_en = "Promotion 1";
        $promotion->name_fr = "promotion 1";
        $promotion->description_es = "Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500.";
        $promotion->description_en = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $promotion->description_fr = "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500.";
        $promotion->discount_es = "15% de descuento";
        $promotion->discount_en = "15% discount";
        $promotion->discount_fr = "15% de réduction";
        $promotion->start_date = "2020-09-20";
        $promotion->end_date = "2020-09-28";
        $promotion->hotel_id = 1;
        $promotion->save();

        $promotion->rooms()->attach([1,4,8]);
        $promotion->rates()->attach([1,2]);

        $promotion = new Promotion();
        $promotion->name_es = "Promoción 2";
        $promotion->name_en = "Promotion 2";
        $promotion->name_fr = "promotion 2";
        $promotion->description_es = "Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500.";
        $promotion->description_en = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $promotion->description_fr = "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500.";
        $promotion->discount_es = "5% de descuento";
        $promotion->discount_en = "5% discount";
        $promotion->discount_fr = "5% de réduction";
        $promotion->start_date = "2020-09-20";
        $promotion->end_date = "2020-09-28";
        $promotion->hotel_id = 2;
        $promotion->save();

        $promotion->rooms()->attach([2,5,9]);
        $promotion->rates()->attach([1,2]);

        $promotion = new Promotion();
        $promotion->name_es = "Promoción 3";
        $promotion->name_en = "Promotion 3";
        $promotion->name_fr = "promotion 3";
        $promotion->description_es = "Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500.";
        $promotion->description_en = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $promotion->description_fr = "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500.";
        $promotion->discount_es = "3% de descuento";
        $promotion->discount_en = "3% discount";
        $promotion->discount_fr = "3% de réduction";
        $promotion->start_date = "2020-09-20";
        $promotion->end_date = "2020-09-28";
        $promotion->hotel_id = 3;
        $promotion->save();

        $promotion->rooms()->attach([1,3,9]);
        $promotion->rates()->attach([1,2]);

        $promotion = new Promotion();
        $promotion->name_es = "Promoción 4";
        $promotion->name_en = "Promotion 4";
        $promotion->name_fr = "promotion 4";
        $promotion->description_es = "Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500.";
        $promotion->description_en = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $promotion->description_fr = "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500.";
        $promotion->discount_es = "10% de descuento";
        $promotion->discount_en = "10% discount";
        $promotion->discount_fr = "10% de réduction";
        $promotion->start_date = "2020-09-20";
        $promotion->end_date = "2020-09-28";
        $promotion->hotel_id = 2;
        $promotion->save();

        $promotion->rooms()->attach([2,4,9]);
        $promotion->rates()->attach([1,2]);
    }
}
