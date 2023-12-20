<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Module;
use App\Models\Degree;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 /*
        DB::table('users')->insert([
            'DNI' => '12345678A',
            'name' => 'Joana',
            'surname' => 'Barber Montaner',
            'phoneNumber1' => 123456789,
            'phoneNumber2' => 334455678,
            'address' => 'Calle Luna Portal nº 17 9A',
            'photo' => "vccccxa7aaA9AS'AS",
            'FCTDUAL' => null,
            'email' => 'admin@elorrieta-errekamari.com',
            'email_verified_at' => null,
            'password' => Hash::make('elorrieta00'),
            'department_id' => null,
            'created_at' => now(),
        ]);
        #Obtenemos el rol de administrador
        $rol = Role::find(1);
        #Obtenemos el usuario creado
        $user = User::find(1);
        $user->roles()->attach($rol);

        DB::table('users')->insert([
            'DNI' => '87654321B',
            'name' => 'David',
            'surname' => 'Comeron Alonso',
            'phoneNumber1' => 263728190,
            'phoneNumber2' => 982134321,
            'address' => 'Calle Nueva Portal nº 7 6D',
            'photo' => "sds7ds8d7s9ds8d9",
            'FCTDUAL' => null,
            'email' => 'david@elorrieta-errekamari.com',
            'email_verified_at' => null,
            'password' => Hash::make('elorrieta00'),
            'department_id' => 1,
            'created_at' => now(),
        ]);
        #Obtenemos el rol de profesor
        $rol = Role::find(2);
        #Obtenemos el usuario creado
        $user = User::find(2);
        $module = Module::all();
        $user->roles()->attach($rol);
        $user->modules()->attach($module);

        DB::table('users')->insert([
            'DNI' => '32819209C',
            'name' => 'Robson',
            'surname' => 'Garcia Junior',
            'phoneNumber1' => 213231243,
            'phoneNumber2' => 454655443,
            'address' => 'Avenida ABC Portal nº 1 4I',
            'photo' => "dsdsxc9a9s0ew",
            'FCTDUAL' => true,
            'email' => 'robson@elorrieta-errekamari.com',
            'email_verified_at' => null,
            'password' => Hash::make('elorrieta00'),
            'department_id' => 1,
            'created_at' => now(),
        ]);
        #Obtenemos el rol de alumno
        $rol = Role::find(3);
        #obtenemos el ciclo que cursará el alumno
        $degree = Degree::find(2);
        $degree2 = Degree::find(4);
        $module = Module::all();
        #Obtenemos el usuario creado
        $user = User::find(3);
        $user->degrees()->attach($degree);
        $user->degrees()->attach($degree2);
        $user->roles()->attach($rol);
        $user->modules()->attach($module);
*/
#FACTORY
        #Creamos 1 admin
        User::factory()->count(1)->create();
        $rol = Role::find(1);

        #Obtenemos los profesores creados
        $users = User::latest()->get();

        #Les asignamos su rol de profesor
        foreach ($users as $user) {
            $user->roles()->attach($rol);
        }

        #Creamos 50 alumnos
        User::factory()->count(50)->create();
        $rol = Role::find(3);

        #Obtenemos los alumnos creados
        $users = User::latest()->limit(50)->get();

        #Les asignamos su rol de alumno
        foreach ($users as $user) {
            $degree = Degree::inRandomOrder()->first();
            $user->roles()->attach($rol);
            $user->degrees()->attach($degree);
        }

        #Creamos 10 profesores
        User::factory()->count(10)->create();
        $rol = Role::find(2);

        #Obtenemos los profesores creados
        $users = User::latest()->limit(10)->get();

        #Les asignamos su rol de profesor
        foreach ($users as $user) {
            $user->roles()->attach($rol);
        }

    }
}
