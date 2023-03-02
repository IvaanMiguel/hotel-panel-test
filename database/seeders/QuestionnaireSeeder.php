<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Questionnaire;
class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionnaire = new Questionnaire();

        $questionnaire->title_es = "CALIFIQUE SU EXPERIENCIA";
        $questionnaire->title_en = "RATE YOUR EXPERIENCE";
        $questionnaire->title_fr = "ÉVALUEZ VOTRE EXPÉRIENCE";

        $questionnaire->description_es = "Basándose en su reciente estancia en nuestro hotel, por favor califique:¡Díganos sus comentarios!";
        $questionnaire->description_en = "Based on your recent stay at our hotel, please rate: Give us your comments!";
        $questionnaire->description_fr = "Sur la base de votre récent séjour dans notre hôtel, veuillez noter: Donnez-nous vos commentaires!";

        $questionnaire->save();
    }
}
