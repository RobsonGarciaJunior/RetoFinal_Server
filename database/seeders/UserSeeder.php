<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(60)->create();
        $rol = Role::find(3);

        $users = User::all();

        foreach($users as $user)
            $user->roles()->attach($rol);
        }
    }
