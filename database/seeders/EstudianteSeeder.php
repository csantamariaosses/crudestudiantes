<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estudiante;


class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estudiante::create( 
		[
		   'nombres' => 'Carlos Santa',
		   'direccion' => 'Pedro Hidalgo 287',
		   'edad' => 60
		]);
        Estudiante::create( 
		[
		   'nombres' => 'Luis Martinez',
		   'direccion' => 'Av.Colon 3000',
		   'edad' => 70
		]);

        Estudiante::create( 
		[
		   'nombres' => 'Jorge Gonzales',
		   'direccion' => 'Av.America 500',
		   'edad' => 50
		]);
    }
}
