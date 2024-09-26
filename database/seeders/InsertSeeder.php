<?php

namespace Database\Seeders;

use App\Models\cargo;
use App\Models\ciudad;
use App\Models\empleado;
use App\Models\pais;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // * Cargos 
        $cargos = [
            ['nombre' => 'Presidente'],
            ['nombre' => 'Gerente General'],
            ['nombre' => 'Jefe de Operaciones'],
            ['nombre' => 'Supervisor'],
            ['nombre' => 'Analista'],
            ['nombre' => 'Asistente']
        ];
        Cargo::insert($cargos);
        // * Pais
        $paises = [
            ['nombre' => 'Colombia'],
            ['nombre' => 'Argentina'],
            ['nombre' => 'México'],
            ['nombre' => 'Chile'],
            ['nombre' => 'Perú'],
        ];
        pais::insert($paises);
        // * Ciudad
        $ciudades = [
            ['nombre' => 'Bogotá', 'pais_id' => 1], // Colombia
            ['nombre' => 'Medellín', 'pais_id' => 1],
            ['nombre' => 'Buenos Aires', 'pais_id' => 2], // Argentina
            ['nombre' => 'Córdoba', 'pais_id' => 2],
            ['nombre' => 'Ciudad de México', 'pais_id' => 3], // México
            ['nombre' => 'Guadalajara', 'pais_id' => 3],
            ['nombre' => 'Santiago', 'pais_id' => 4], // Chile
            ['nombre' => 'Valparaíso', 'pais_id' => 4],
            ['nombre' => 'Lima', 'pais_id' => 5], // Perú
            ['nombre' => 'Arequipa', 'pais_id' => 5],
        ];
        ciudad::insert($ciudades);
        $empleados = [
            [
                'nombres' => 'Jefry',
                'apellidos' => 'Manzanares Torres',
                'identificacion' => '1000468666',
                'direccion' => 'CR 78 58 42 SUR',
                'telefono' => '3042704870',
                'ciudad_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];
        empleado::insert($empleados);
        $cargo_empleado = [
            [
                'empleado_id' => 1,
                'cargo_id' => 1
            ],
            [
                'empleado_id' => 1,
                'cargo_id' => 2
            ]
        ];
        DB::table('cargo_empleado')->insert($cargo_empleado);
    }
}
