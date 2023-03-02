<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;
class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question = new Question();

        $question->text_es = "¿Cuál es la probabilidad de que nos recomiende?";
        $question->text_en = "What is the probability that he will recommend us?";
        $question->text_fr = "Quelle est la probabilité que vous nous recommandiez ?";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "Opinión general de su estancia. ";
        $question->text_en = "General opinion of your stay. ";
        $question->text_fr = "Avis général de votre séjour. ";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "Su experiencia general al momento del check-in y check out.";
        $question->text_en = "Your overall experience at check-in and check-out.";
        $question->text_fr = "Votre expérience globale à l'enregistrement et au départ.";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "Satisfacción general respecto a la limpieza de nuestras habitaciones y amenidades";
        $question->text_en = "General satisfaction regarding the cleanliness of our rooms and amenities";
        $question->text_fr = "Satisfaction générale concernant la propreté de nos chambres et équipements";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();
        
        $question->text_es = "Experiencia general respecto a los servicios de Alimentos y Bebidas.";
        $question->text_en = "General experience regarding Food and Beverage services.";
        $question->text_fr = "Expérience générale des services de restauration et de boissons.";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "Satisfacción general sobre nuestros servicios de Internet.";
        $question->text_en = "General satisfaction with our Internet services.";
        $question->text_fr = "Satisfaction générale de nos services Internet.";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "Satisfacción general respecto a la comodidad de nuestras habitaciones y espacios.";
        $question->text_en = "General satisfaction regarding the comfort of our rooms and spaces.";
        $question->text_fr = "Satisfaction générale concernant le confort de nos chambres et espaces.";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "Muy probablemente regresará al hotel.";
        $question->text_en = "He will most likely return to the hotel.";
        $question->text_fr = "Il retournera probablement à l'hôtel.";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "Valor obtenido por el precio pagado";
        $question->text_en = "Value obtained for the price paid";
        $question->text_fr = "Valeur obtenue pour le prix payé";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "El personal respondió a sus necesidades.";
        $question->text_en = "The staff responded to your needs.";
        $question->text_fr = "Le personnel a répondu à vos besoins.";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();

        $question = new Question();

        $question->text_es = "La actitud del personal del hotel reflejó un interés auténtico y un deseo de ofrecer una experiencia única.";
        $question->text_en = "The attitude of the hotel staff reflected a genuine interest and a desire to offer a unique experience.";
        $question->text_fr = "L'attitude du personnel de l'hôtel reflétait un réel intérêt et un désir d'offrir une expérience unique.";

        $question->is_required = true;
        $question->questionnaire_id = 1;
        $question->save();
    }
}
