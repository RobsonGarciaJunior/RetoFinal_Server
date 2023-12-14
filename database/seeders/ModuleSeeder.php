<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insert([
            'name' => 'Programación',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Lenguaje de Marcas',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Entornos de Desarrollo',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'FOL',
            'created_at' => now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'EMPRESA',
            'created_at' => now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Mecanizado',
            'created_at' => now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Trazado, corte y conformado',
            'created_at' => now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Metrología y ensayos',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Soldadura en atmósfera protegida',
            'created_at' => now(),
        ]);
    }
}
