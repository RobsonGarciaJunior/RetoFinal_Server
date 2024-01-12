<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Department;
use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $dni = mt_rand(1000000, 99999999) . $characters[rand(0, strlen($characters) - 1)];
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        // Eliminar tildes
        $firstName = str_replace(['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'], ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'], $firstName);
        $lastName = str_replace(['á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'], ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'], $lastName);

        // Obtener solo la primera palabra para que no existan nombres compuestos
        $firstNameParts = explode(' ', $firstName);
        $firstName = $firstNameParts[0];
        $pass = Hash::make('elorrieta00');
        return [
            'DNI' => $dni,
            'name' => $firstName,
            'surname' => $lastName,
            'phone_number1' => fake()->unique()->numerify('#########'),
            'phone_number2' => fake()->unique()->numerify('#########'),
            'address' => $this->faker->address(),
            'email' => $firstName . $lastName . '@elorrieta.com',
            'email_verified_at' => now(),
            'password' => $pass,
            'remember_token' => Str::random(10),
            'department_id' => null,
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    public function student()
    {
        return $this->state(function (array $attributes) {
            return [
                'photo' => null,
                'FCTDUAL' => $this->faker->boolean(),
                'department_id' => null,
            ];
        });
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => 'admin@elorrieta.com',
                'photo' => null,
                'FCTDUAL' => null,
                'department_id' => Department::find(1)->id,
            ];
        });
    }

    public function professor(Collection $modules)
    {
        #$degree = $modules->degrees->id->first();
        return $this->state(function (array $attributes) {
            return [
                'photo' => null,
                'FCTDUAL' => null,
                'department_id' => Department::find(2)->id,
            ];
        });
    }
}
