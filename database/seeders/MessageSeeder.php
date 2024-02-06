<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            'text' => 'Holaa',
            'chat_id' => 1,
            'user_id' => 12,
            'type' => 0,
            'created_at' => now(),
        ]);
    }
}
