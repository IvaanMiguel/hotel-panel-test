<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FacturationData;
class FacturationDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facturacion_data = new FacturationData();
        $facturacion_data->razon_social = "Jose Antonio";
        $facturacion_data->document_type = "tipo documento";
        $facturacion_data->document_number = "234";
        $facturacion_data->address = "Colonia 1";
        $facturacion_data->zip_code = "36485";
        $facturacion_data->state = "B.C.S";
        $facturacion_data->city = "La Paz";
        $facturacion_data->country_id = 142;
        $facturacion_data->save();

        $facturacion_data = new FacturationData();
        $facturacion_data->razon_social = "Pedro Armando";
        $facturacion_data->document_type = "tipo documento";
        $facturacion_data->document_number = "23";
        $facturacion_data->address = "Colonia 1";
        $facturacion_data->zip_code = "36485";
        $facturacion_data->state = "B.C.S";
        $facturacion_data->city = "La Paz";
        $facturacion_data->country_id = 142;
        $facturacion_data->save();

        $facturacion_data = new FacturationData();
        $facturacion_data->razon_social = "Fernanda Maria";
        $facturacion_data->document_type = "tipo documento";
        $facturacion_data->document_number = "12";
        $facturacion_data->address = "Colonia 1";
        $facturacion_data->zip_code = "36485";
        $facturacion_data->state = "B.C.S";
        $facturacion_data->city = "Los Cabos";
        $facturacion_data->country_id = 142;
        $facturacion_data->save();
    }
}
