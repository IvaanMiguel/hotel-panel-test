<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Option;
class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ////// opciones pregunta 1
        $option = new Option();
        $option->text_es = "Por excelencia";
        $option->text_en = "By excellence";
        $option->text_fr = "Par excellence";
        $option->question_id = 1;
        $option->save();

        $option = new Option();
        $option->text_es = "SI";
        $option->text_en = "YES";
        $option->text_fr = "OUI";
        $option->question_id = 1;
        $option->save();

        $option = new Option();
        $option->text_es = "NO";
        $option->text_en = "NOT";
        $option->text_fr = "NE PAS";
        $option->question_id = 1;
        $option->save();

        $option = new Option();
        $option->text_es = "Ni por equivocación";
        $option->text_en = "Not by mistake";
        $option->text_fr = "Pas par erreur";
        $option->question_id = 1;
        $option->save();

        ////// opciones pregunta 2
        $option = new Option();
        $option->text_es = "Excelente";
        $option->text_en = "Excellent";
        $option->text_fr = "Excellent";
        $option->question_id = 2;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy buena";
        $option->text_en = "Very good";
        $option->text_fr = "Très bonne";
        $option->question_id = 2;
        $option->save();

        $option = new Option();
        $option->text_es = "Buena";
        $option->text_en = "Good";
        $option->text_fr = "bonne";
        $option->question_id = 2;
        $option->save();

        $option = new Option();
        $option->text_es = "Deficiente";
        $option->text_en = "Deficient";
        $option->text_fr = "Déficient";
        $option->question_id = 2;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy mala";
        $option->text_en = "Very bad";
        $option->text_fr = "Très méchante";
        $option->question_id = 2;
        $option->save();

        ////// opciones pregunta 3
        $option = new Option();
        $option->text_es = "Excelente";
        $option->text_en = "Excellent";
        $option->text_fr = "Excellent";
        $option->question_id = 3;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy buena";
        $option->text_en = "Very good";
        $option->text_fr = "Très bonne";
        $option->question_id = 3;
        $option->save();

        $option = new Option();
        $option->text_es = "Buena";
        $option->text_en = "Good";
        $option->text_fr = "bonne";
        $option->question_id = 3;
        $option->save();

        $option = new Option();
        $option->text_es = "Deficiente";
        $option->text_en = "Deficient";
        $option->text_fr = "Déficient";
        $option->question_id = 3;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy mala";
        $option->text_en = "Very bad";
        $option->text_fr = "Très méchante";
        $option->question_id = 3;
        $option->save();

        ////// opciones pregunta 4
        $option = new Option();
        $option->text_es = "Excelente";
        $option->text_en = "Excellent";
        $option->text_fr = "Excellent";
        $option->question_id = 4;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy buena";
        $option->text_en = "Very good";
        $option->text_fr = "Très bonne";
        $option->question_id = 4;
        $option->save();

        $option = new Option();
        $option->text_es = "Buena";
        $option->text_en = "Good";
        $option->text_fr = "bonne";
        $option->question_id = 4;
        $option->save();

        $option = new Option();
        $option->text_es = "Deficiente";
        $option->text_en = "Deficient";
        $option->text_fr = "Déficient";
        $option->question_id = 4;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy mala";
        $option->text_en = "Very bad";
        $option->text_fr = "Très méchante";
        $option->question_id = 4;
        $option->save();

        ////// opciones pregunta 5
        $option = new Option();
        $option->text_es = "Excelente";
        $option->text_en = "Excellent";
        $option->text_fr = "Excellent";
        $option->question_id = 5;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy buena";
        $option->text_en = "Very good";
        $option->text_fr = "Très bonne";
        $option->question_id = 5;
        $option->save();

        $option = new Option();
        $option->text_es = "Buena";
        $option->text_en = "Good";
        $option->text_fr = "bonne";
        $option->question_id = 5;
        $option->save();

        $option = new Option();
        $option->text_es = "Deficiente";
        $option->text_en = "Deficient";
        $option->text_fr = "Déficient";
        $option->question_id = 5;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy mala";
        $option->text_en = "Very bad";
        $option->text_fr = "Très méchante";
        $option->question_id = 5;
        $option->save();

        ////// opciones pregunta 6
        $option = new Option();
        $option->text_es = "Excelente";
        $option->text_en = "Excellent";
        $option->text_fr = "Excellent";
        $option->question_id = 6;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy buena";
        $option->text_en = "Very good";
        $option->text_fr = "Très bonne";
        $option->question_id = 6;
        $option->save();

        $option = new Option();
        $option->text_es = "Buena";
        $option->text_en = "Good";
        $option->text_fr = "bonne";
        $option->question_id = 6;
        $option->save();

        $option = new Option();
        $option->text_es = "Deficiente";
        $option->text_en = "Deficient";
        $option->text_fr = "Déficient";
        $option->question_id = 6;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy mala";
        $option->text_en = "Very bad";
        $option->text_fr = "Très méchante";
        $option->question_id = 6;
        $option->save();

        ////// opciones pregunta 7
        $option = new Option();
        $option->text_es = "Excelente";
        $option->text_en = "Excellent";
        $option->text_fr = "Excellent";
        $option->question_id = 7;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy buena";
        $option->text_en = "Very good";
        $option->text_fr = "Très bonne";
        $option->question_id = 7;
        $option->save();

        $option = new Option();
        $option->text_es = "Buena";
        $option->text_en = "Good";
        $option->text_fr = "bonne";
        $option->question_id = 7;
        $option->save();

        $option = new Option();
        $option->text_es = "Deficiente";
        $option->text_en = "Deficient";
        $option->text_fr = "Déficient";
        $option->question_id = 7;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy mala";
        $option->text_en = "Very bad";
        $option->text_fr = "Très méchante";
        $option->question_id = 7;
        $option->save();

        ////// opciones pregunta 8
        $option = new Option();
        $option->text_es = "Muy seguro";
        $option->text_en = "Very sure";
        $option->text_fr = "Très sûr";
        $option->question_id = 8;
        $option->save();

        $option = new Option();
        $option->text_es = "Seguramente SI";
        $option->text_en = "Surely yes";
        $option->text_fr = "Sûrement oui";
        $option->question_id = 8;
        $option->save();

        $option = new Option();
        $option->text_es = "Seguramente NO";
        $option->text_en = "Probably not";
        $option->text_fr = "Probablement pas";
        $option->question_id = 8;
        $option->save();

        $option = new Option();
        $option->text_es = "Nunca";
        $option->text_en = "Never";
        $option->text_fr = "Jamais";
        $option->question_id = 8;
        $option->save();

        ////// opciones pregunta 9
        $option = new Option();
        $option->text_es = "Muy justo";
        $option->text_en = "Very fair";
        $option->text_fr = "Très juste";
        $option->question_id = 9;
        $option->save();

        $option = new Option();
        $option->text_es = "Justo";
        $option->text_en = "Just";
        $option->text_fr = "Juste";
        $option->question_id = 9;
        $option->save();

        $option = new Option();
        $option->text_es = "No tan justo";
        $option->text_en = "Not so fair";
        $option->text_fr = "Pas si juste";
        $option->question_id = 9;
        $option->save();

        $option = new Option();
        $option->text_es = "Injusto";
        $option->text_en = "Unfair";
        $option->text_fr = "Injuste";
        $option->question_id = 9;
        $option->save();

        $option = new Option();
        $option->text_es = "Completamente injusto";
        $option->text_en = "Completely unfair";
        $option->text_fr = "Complètement injuste";
        $option->question_id = 9;
        $option->save();

        ////// opciones pregunta 10
        $option = new Option();
        $option->text_es = "Excelente";
        $option->text_en = "Excellent";
        $option->text_fr = "Excellent";
        $option->question_id = 10;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy bien";
        $option->text_en = "very well";
        $option->text_fr = "Très bien";
        $option->question_id = 10;
        $option->save();

        $option = new Option();
        $option->text_es = "Bien";
        $option->text_en = "Good";
        $option->text_fr = "Bien";
        $option->question_id = 10;
        $option->save();

        $option = new Option();
        $option->text_es = "Deficiente";
        $option->text_en = "Deficient";
        $option->text_fr = "Déficient";
        $option->question_id = 10;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy mal";
        $option->text_en = "Very bad";
        $option->text_fr = "Très mal";
        $option->question_id = 10;
        $option->save();

        ////// opciones pregunta 11
        $option = new Option();
        $option->text_es = "Excelente";
        $option->text_en = "Excellent";
        $option->text_fr = "Excellent";
        $option->question_id = 11;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy bien";
        $option->text_en = "very well";
        $option->text_fr = "Très bien";
        $option->question_id = 11;
        $option->save();

        $option = new Option();
        $option->text_es = "Bien";
        $option->text_en = "Good";
        $option->text_fr = "Bien";
        $option->question_id = 11;
        $option->save();

        $option = new Option();
        $option->text_es = "Deficiente";
        $option->text_en = "Deficient";
        $option->text_fr = "Déficient";
        $option->question_id = 11;
        $option->save();

        $option = new Option();
        $option->text_es = "Muy mal";
        $option->text_en = "Very bad";
        $option->text_fr = "Très mal";
        $option->question_id = 11;
        $option->save();

    }
}
