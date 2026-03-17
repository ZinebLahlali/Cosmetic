<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(20, 50, 500),
            'slug' => fake()->slug(),
            'description' => fake()->sentence(),
            'categorie_id' => fake()->numberBetween(1,3),
        ];
    }
}
