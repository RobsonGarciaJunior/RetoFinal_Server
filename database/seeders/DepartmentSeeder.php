<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            'name' => 'Informática',
            'created_at' => now(),
        ]);
        DB::table('departments')->insert([
            'name' => 'FOL',
            'created_at' => now(),
        ]);
        DB::table('departments')->insert([
            'name' => 'Fabricación Mecánica',
            'created_at' => now(),
        ]);
        DB::table('departments')->insert([
            'name' => 'Química',
            'created_at' => now(),
        ]);
    }
}
