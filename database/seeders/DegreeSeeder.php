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
        DB::table('degrees')->insert([
            'name' => 'SMR',
            'department_id' => 1,
            'created_at' => now(),
        ]);
        #Obtenemos los modulos propios de SMR
        $modules = Module::whereIn(
            'name',
            [
                'Aplicaciones ofimáticas',
                'Redes locales',
                'Seguridad informática',
                'FOL',
                'EMPRESA'
            ]
        )->get();
        #Obtenemos el ciclo de smr que acabamos de crear
        $degree = Degree::find(1);
        #Vinculamos el ciclo con sus modulos
        $degree->modules()->attach($modules);

        DB::table('degrees')->insert([
            'name' => 'DAM',
            'department_id' => 1,
            'created_at' => now(),
        ]);
        #Obtenemos los modulos propios de DAM
        $modules = Module::whereIn(
            'name',
            [
                'Programación',
                'Lenguaje de Marcas',
                'FOL',
                'EMPRESA'
            ]
        )->get();
        #Obtenemos el ciclo de DAM que acabamos de crear
        $degree = Degree::find(2);
        #Vinculamos el ciclo con sus modulos
        $degree->modules()->attach($modules);

        DB::table('degrees')->insert([
            'name' => 'DAW',
            'department_id' => 1,
            'created_at' => now(),
        ]);
        #Obtenemos el ciclo de DAW que acabamos de crear
        $degree = Degree::find(3);
        #Vinculamos el ciclo con sus modulos
        $degree->modules()->attach($modules);

        DB::table('degrees')->insert([
            'name' => 'Soldadura y Calderería',
            'department_id' => 3,
            'created_at' => now(),
        ]);
        #Obtenemos los modulos propios de Soldadura
        $modules = Module::whereIn(
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
        #Obtenemos el ciclo de Soldadura que acabamos de crear
        $degree = Degree::find(4);
        #Vinculamos el ciclo con sus modulos
        $degree->modules()->attach($modules);
    }
}
