<?php

namespace Database\Seeders;

use App\Models\BillingData;
use App\Models\Country;
use App\Models\Reservation;
use App\Models\UsoCfdi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country_ids = Country::pluck('id');
        $uso_cfdi_ids = UsoCfdi::pluck('id');
        $reservation_ids = Reservation::pluck('id');
    

        foreach($reservation_ids as $reservation_id){

            $billing_data = BillingData::create([
                'razon_social' => 'jose antonio',
                'document_type' => 'tipo documento',
                'document_number' => '234',
                'address' => 'Colonia 1',
                'zip_code' => fake()->postcode,
                'state' => 'B.C.S',
                'city' => 'La Paz',
                'country_id' => $country_ids->random(),
                'uso_cfdi_id' => $uso_cfdi_ids->random(),
                'email' => fake()->email(),
                'tax_regime' => fake()->text(),
                'tax_postal_code' => fake()->postcode(),
                'reservation_id' => $reservation_id       
            ]);
        }
     /*  
        $facturacion_data = new FacturacionData();
        $facturacion_data->razon_social = "Jose Antonio";
        $facturacion_data->document_type = "tipo documento";
        $facturacion_data->document_number = "234";
        $facturacion_data->address = "Colonia 1";
        $facturacion_data->zip_code = "36485";
        $facturacion_data->state = "B.C.S";
        $facturacion_data->city = "La Paz";
        $facturacion_data->country_id = 142;
        $facturacion_data->save();

        $facturacion_data = new FacturacionData();
        $facturacion_data->razon_social = "Pedro Armando";
        $facturacion_data->document_type = "tipo documento";
        $facturacion_data->document_number = "23";
        $facturacion_data->address = "Colonia 1";
        $facturacion_data->zip_code = "36485";
        $facturacion_data->state = "B.C.S";
        $facturacion_data->city = "La Paz";
        $facturacion_data->country_id = 142;
        $facturacion_data->save();

        $facturacion_data = new FacturacionData();
        $facturacion_data->razon_social = "Fernanda Maria";
        $facturacion_data->document_type = "tipo documento";
        $facturacion_data->document_number = "12";
        $facturacion_data->address = "Colonia 1";
        $facturacion_data->zip_code = "36485";
        $facturacion_data->state = "B.C.S";
        $facturacion_data->city = "Los Cabos";
        $facturacion_data->country_id = 142;
        $facturacion_data->save(); */
    }
}
