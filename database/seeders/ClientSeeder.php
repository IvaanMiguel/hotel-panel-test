<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents('database/jsons/clients.json'), true);

        foreach($data as $values){
            $client = Client::create([
                'name' => $values['name'],
                'phone_number' => $values['phone_number'],
                'email' => $values['email'],
                'password' => Hash::make($values['password']),
                'subscribed' => $values['subscribed'],
                'country_id' => $values['country_id']
            ]);
        } 
    }
}
