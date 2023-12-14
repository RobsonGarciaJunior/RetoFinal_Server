<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Profesor',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Estudiante',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Jefe De Departamento',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Dirección',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Bedel',
            'created_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Limpieza',
            'created_at' => now(),
        ]);
    }
}
