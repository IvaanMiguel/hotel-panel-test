<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\client;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = new Client();
        $client->name = "Jose Antonio";
        $client->email = "Jose@gmail.com";
        $client->phone_number = "6123564789";
        $client->password = bcrypt("secret");
        $client->country_id = 142;
        $client->save();

        $client = new Client();
        $client->name = "Pedro Armando";
        $client->email = "Pedro@gmail.com";
        $client->phone_number = "6123564789";
        $client->password = bcrypt("secret");
        $client->country_id = 142;
        $client->save();

        $client = new Client();
        $client->name = "Fernanda Maria";
        $client->email = "Fernanda@gmail.com";
        $client->phone_number = "6123564789";
        $client->password = bcrypt("secret");
        $client->country_id = 142;
        $client->save();

        $client = new Client();
        $client->name = "Manuel Carlos";
        $client->email = "Manuel@gmail.com";
        $client->phone_number = "6123564789";
        $client->password = bcrypt("secret");
        $client->country_id = 142;
        $client->save();
    }
}
