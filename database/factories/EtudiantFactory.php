<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
  public function definition(): array
  {
    return [
      'user_id' => \App\Models\User::factory(),
      'nom' => $this->faker->lastName(),
      'prenom' => $this->faker->firstName(),
      'etablissement' => $this->faker->company(),
      'email' => $this->faker->unique()->safeEmail(),
      'telephone' => $this->faker->phoneNumber(),
      'adresse' => $this->faker->address(),
      'carte_nationale' => $this->faker->unique()->bothify('??######'),
      'carte_etudiant' => $this->faker->optional()->bothify('ETU######'),
      'img_user' => null,
      'img_carte_nationale' => null,
      'img_carte_nationale_verso' => null,
      'img_carte_etudiant' => null,
    ];
  }
}
