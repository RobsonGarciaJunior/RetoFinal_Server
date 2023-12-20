<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Department;
use App\Models\Degree;

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
        $pass = Hash::make('elorrieta00');
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $dni = mt_rand(1000000, 99999999) . $characters[rand(0, strlen($characters) - 1)];
        return [
            'DNI' => $dni,
            'name' => $firstName,
            'surname' => $lastName,
            'phoneNumber1' => fake()->unique()->numerify('#########'),
            'phoneNumber2' => fake()->unique()->numerify('#########'),
            'address' => $this->faker->address(),
            'photo' => null,
            'FCTDUAL' => $this->faker->boolean(),
            'email' => $firstName . $lastName . '@elorrieta-errekamari.com',
            'email_verified_at' => now(),
            'password' => $pass,
            'remember_token' => Str::random(10),
            'department_id' => Department::all()->random()->id,
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
}
