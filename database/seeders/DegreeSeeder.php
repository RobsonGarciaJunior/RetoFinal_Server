<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('degrees')->insert([
            'name' => 'ASIR',
            'created_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'name' => 'DAM',
            'created_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'name' => 'DAW',
            'created_at' => now(),
        ]);
        DB::table('degrees')->insert([
            'name' => 'Soldadura y Calderería',
            'created_at' => now(),
        ]);
    }
}
