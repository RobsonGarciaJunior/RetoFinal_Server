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
            'name' => 'Aplicaciones ofimáticas',
            'hours' => 270,
            'code' => '0175',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Redes locales',
            'hours' => 240,
            'code' => '0190',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Seguridad informática',
            'hours' => 85,
            'code' => '0120',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Programación',
            'hours' => 256,
            'code' => '0485',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Lenguaje de Marcas',
            'hours' => 128,
            'code' => '0373',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Entornos de Desarrollo',
            'hours' => 96,
            'code' => '0487',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'FOL',
            'hours' => 96,
            'code' => '0493',
            'created_at' => now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'EMPRESA',
            'hours' => 84,
            'code' => '0494',
            'created_at' => now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Mecanizado',
            'hours' => 165,
            'code' => '0222',
            'created_at' => now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Trazado, corte y conformado',
            'hours' => 264,
            'code' => '0265',
            'created_at' => now(),
        ]);

        DB::table('modules')->insert([
            'name' => 'Metrología y ensayos',
            'hours' => 132,
            'code' => '0277',
            'created_at' => now(),
        ]);
        DB::table('modules')->insert([
            'name' => 'Soldadura en atmósfera protegida',
            'hours' => 231,
            'code' => '0288',
            'created_at' => now(),
        ]);
    }
}
