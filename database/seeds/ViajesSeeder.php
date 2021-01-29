<?php

use Illuminate\Database\Seeder;

class ViajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('viajes')->insert([
            [
                'numero_plazas' => 50,
                'plazas_disponibles' => 50,
                'origen' => 'Maiquetia Venezuela',
                'destino' => 'Santo Domingo República Dominicana',
                'precio' => 500
            ],
            [
                'numero_plazas' => 40,
                'plazas_disponibles' => 40,
                'origen' => 'Maiquetia Venezuela',
                'destino' => 'Lima Peru',
                'precio' => 700
            ]
        ]);
    }
}
