<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => null, // Set in seeder if needed
            'full_name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'cin' => strtoupper(Str::random(8)),
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'school' => $this->faker->company(),
        ];
    }
}
