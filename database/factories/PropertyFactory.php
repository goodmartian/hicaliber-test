<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        return [
            'name' => fake()->streetAddress(),
            'price' => fake()->numberBetween(100000, 1000000),
            'bedrooms' => fake()->numberBetween(1, 6),
            'bathrooms' => fake()->numberBetween(1, 4),
            'storeys' => fake()->numberBetween(1, 3),
            'garages' => fake()->numberBetween(0, 3),
        ];
    }
}
