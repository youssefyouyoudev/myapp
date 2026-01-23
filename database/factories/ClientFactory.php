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
          'user_id' => \App\Models\User::factory(),
          'full_name' => $this->faker->name(),
          'phone' => $this->faker->phoneNumber(),
          'status' => $this->faker->randomElement(['active', 'suspended']),
          'cin' => $this->faker->unique()->bothify('??######'),
          'date_of_birth' => $this->faker->date(),
          'school' => $this->faker->company(),
          'user_id' => 2,
        ];
    }
}
