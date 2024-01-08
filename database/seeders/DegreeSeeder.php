<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Module;
use App\Models\Degree;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #Obtenemos los modulos propios de SMR
        $modulesSMR = Module::whereIn('name', [
            'Aplicaciones ofimáticas',
            'Redes locales',
            'Seguridad informática',
            'FOL',
            'EMPRESA'
        ])->get();
        #Creamos SMR
        DB::table('degrees')->insert([
            'name' => 'SMR',
            'department_id' => 2,
            'created_at' => now(),
        ]);
        #Obtenemos el ciclo de SMR que acabamos de crear
        $degreeSMR = Degree::find(1);
        #Vinculamos el ciclo con sus modulos
        $degreeSMR->modules()->attach($modulesSMR);

        #Obtenemos los modulos propios de DAM
        $modulesDAM = Module::whereIn('name', [
            'Programación',
            'Lenguaje de Marcas',
            'FOL',
            'EMPRESA'
        ])->get();
        #Creamos DAM
        DB::table('degrees')->insert([
            'name' => 'DAM',
            'department_id' => 2,
            'created_at' => now(),
        ]);
        #Obtenemos el ciclo de DAM que acabamos de crear
        $degreeDAM = Degree::find(2);
        #Vinculamos el ciclo con sus modulos
        $degreeDAM->modules()->attach($modulesDAM);

        #Creamos DAW
        DB::table('degrees')->insert([
            'name' => 'DAW',
            'department_id' => 2,
            'created_at' => now(),
        ]);
        #Obtenemos el ciclo de DAW que acabamos de crear
        $degreeDAW = Degree::find(3);
        #Vinculamos el ciclo con sus modulos
        $degreeDAW->modules()->attach($modulesDAM);

        #Obtenemos los modulos propios de Soldadura
        $modulesSoldadura  = Module::whereIn(
            'name',
            [
                'Mecanizado',
                'Trazado, corte y conformado',
                'Metrología y ensayos',
                'Soldadura en atmósfera protegida',
                'FOL',
                'EMPRESA'
            ]
        )->get();
        #Creamos Soldadura y Calderería
        DB::table('degrees')->insert([
            'name' => 'Soldadura y Calderería',
            'department_id' => 4,
            'created_at' => now(),
        ]);
        #Obtenemos el ciclo de Soldadura que acabamos de crear
        $degreeSoldadura  = Degree::find(4);
        #Vinculamos el ciclo con sus modulos
        $degreeSoldadura ->modules()->attach($modulesSoldadura);
    }
}
