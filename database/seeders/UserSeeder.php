<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Module;
use App\Models\Degree;
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

        #Obtenemos el rol de admin
        $rol = Role::find(Role::IS_ADMIN);
        #Creamos 1 admin
        User::factory(1)->create()->each(function ($user) use ($rol) {
            $user->roles()->attach($rol);
        });

        #Obtenemos todos los ciclos
        $degree = Degree::all();
        #Obtenemos el rol de alumno
        $rol = Role::find(Role::IS_STUDENT);
        #Creamos 50 alumnos
        User::factory(50)->student()->create()->each(function ($user) use ($degree, $rol) {
            $user->degrees()->attach($degree->random(2));
            $user->roles()->attach($rol);
        });

        ##FIXME Al poder dar clase en diferentes modulos, tmb da clase en diferentes ciclos por lo que pertenece a diferentes departamentos tambien; a no ser que de clase en modulos de un mismo ciclo
        #Obtenemos el rol de profesor
        $rol = Role::find(Role::IS_PROFESSOR);
        #Obtenemos todos los modulos
        $degreeId = rand(1, 4);
        #FIXME
        $modules = Degree::find(1)->modules()->get()->toArray();
        #Creamos 10 profesores
        User::factory(10)->professor($modules)->create()->each (function ($user) use ($modules, $rol) {
            $user->roles()->attach($rol);
            #Le agregamos 5 modulos aleatorios
            $user->modules()->attach($modules->random(5));
        });
    }
}
