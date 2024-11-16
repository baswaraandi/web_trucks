<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    protected $model = \App\Models\Driver::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'license_number' => strtoupper($this->faker->bothify('??#####')),
            'exp_sim' => $this->faker->dateTimeBetween('+1 months', '+6 months')->format('Y-m-d'),
            'experience_years' => $this->faker->numberBetween(1, 20),
        ];
    }
}
