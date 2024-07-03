<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'role' => $this->faker->randomElement(['Admin', 'Supervisor', 'Agent']),
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password',
            'location' => $this->faker->latitude . ',' . $this->faker->longitude,
            'dob' => $this->faker->date,
            'timezone' => $this->faker->timezone,
        ];
    }
}
