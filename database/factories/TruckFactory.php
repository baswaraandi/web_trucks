<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TruckFactory extends Factory
{
    protected $model = \App\Models\Truck::class;

    public function definition()
    {
        return [
            'license_plate' => strtoupper(fake()->bothify('??####??')),
            'model' => fake()->randomElement(['Isuzu Elf', 'Hino Dutro', 'Mitsubishi Fuso', 'Toyota Dyna']),
            'capacity' => fake()->numberBetween(3000, 5000),
            'exp_kir' => fake()->dateTimeBetween('+1 months', '+6 months')->format('Y-m-d'), 
            'status' => fake()->randomElement(['Available', 'In Use', 'Under Maintenance', 'Decommissioned']),
        ];
    }
}
