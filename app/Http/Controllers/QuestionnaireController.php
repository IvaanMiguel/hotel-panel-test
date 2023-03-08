<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Carbon;
use App\Models\Reservation;
use App\Mail\QuestionnaireEmail;
class QuestionnaireController extends Controller
{
   
    

    public static function process(){
    /*     $reservation = Reservation::find(1);
        $reservation->questionnaire = Questionnaire::find(1);
        Mail::to($reservation->client->email)->send(new QuestionnaireEmail($reservation)); */
        // return;   
        echo("\n");
        echo "._____________."."\n";
        echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";

        //get reservaciones que no hayan contestado la encuesta
        $reservations = Reservation::where('status','confirmada')
                        ->with('room.hotel')
                        ->select('id','check_out','client_id','room_id','lang')
                        ->with('client:id,name,email')
                        ->whereDoesntHave('reply')
                        ->with('questionnaires:id')
                        ->get();

        $questionnaire = Questionnaire::where('id', 1)
                         ->with(['questions' => function($q) {
                            $q->where('status', true);
                            $q->with(['options' => function($q) {
                                $q->where('status', true);
                            }]);
                         }])
                         ->first();

        $count_send = 0;
        $current_date = Carbon::now();

        // $reservations = [12,34,45,56];
        if(count($reservations) > 0){
            foreach ($reservations as $reservation) {
                
                if($count_send <= 0){
                    $send = false;
                    //verificar si no se ha enviado ninguna notifiacaicon
                    if(count($reservation->questionnaires) == 0){
                        if($current_date->diffInDays($reservation->check_out)>=2){
                            $send = true;
                            $reservation->questionnaires()->attach(1, [
                                'count' => 1,
                                'last_send' => now(),
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }else{
                        //si ya se envio previamente, verificar veces
                        if($reservation->questionnaires[0]->pivot->count < 3){
                            if($current_date->diffInDays($reservation->questionnaires[0]->pivot->last_send) >= 4){
                                $send = true;
                                $reservation->questionnaires()->updateExistingPivot(1, [
                                    'last_send' => now()
                                ]);
                                $reservation->questionnaires[0]->pivot->increment('count');
                            }
                        }
                    }

                    //enviar
                    if($send){
                        $count_send++;
                        // mandar correo con cuestionario
                        $reservation->questionnaire = $questionnaire;
                       Mail::to($reservation->client->email)->send(new QuestionnaireEmail($reservation));
                    }
                }

            }

        }

        echo "total de notificados: ".$count_send." "."\n";

        echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";
        echo "._____________."."\n";
        echo("\n");
    }
}
