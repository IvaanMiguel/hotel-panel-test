<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact_ids = Contact::inRandomORder()->pluck('id');
        $user_ids = User::inRandomOrder()->pluck('id'); 
        foreach($contact_ids as $contact_id){
        
            Answer::factory(random_int(0, 4))->create([
                'contact_id' => $contact_id,
                'user_id' => $user_ids->random()
            ]);
        }

    }
}
