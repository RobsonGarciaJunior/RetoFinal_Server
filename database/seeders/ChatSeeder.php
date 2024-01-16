<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Chat;
use App\Models\User;



class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chats')->insert([
            'name' => 'Grupo1',
            'type' => 0,
            'user_id' => 55,
            'created_at' => now(),
        ]);
        $chat1 = Chat::find(1);
        $users = User::where('id', '<>', 1)
        ->inRandomOrder()
        ->take(5)
        ->get();
        // Agregar el usuario con ID 55 a la colección
        $user55 = User::find(55);
        if ($user55) {
            $users->push($user55);
        }

        $chat1->users()->attach($users);
        DB::table('chats')->insert([
            'name' => 'Grupo2',
            'type' => 1,
            'user_id' => 58,
            'created_at' => now(),
        ]);
        $chat2 = Chat::find(2);
        $users2 = User::where('id', '<>', 1)
        ->inRandomOrder()
        ->take(5)
        ->get();
        $user58 = User::find(58);
        if ($user58) {
            $users2->push($user58);
        }
        $chat2->users()->attach($users2);
    }
}
