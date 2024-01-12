<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chats')->insert([
            'name' => 'Grupo1',
            'type' => 1,
            'user_id' => 55,
            'created_at' => now(),
        ]);
        DB::table('chats')->insert([
            'name' => 'Grupo2',
            'type' => 2,
            'user_id' => 58,
            'created_at' => now(),
        ]);
    }
}
