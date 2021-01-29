<?php

use Illuminate\Database\Seeder;

class ViajerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('viajeros')->insert([
            [
                'cedula' => 11111111,
                'nombre' => 'Daniel Castro',
                'fecha_nacimiento' => '2015-08-31',
                'telefono' => '+584121112233'
            ],
            [
                'cedula' => 22222222,
                'nombre' => 'Gabriela Yrazabal',
                'fecha_nacimiento' => '1983-11-22',
                'telefono' => '+584141112233'
            ]
        ]);
    }
}
