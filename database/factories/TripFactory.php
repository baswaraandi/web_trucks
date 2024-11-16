<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Truck;
use App\Models\Driver;

class TripFactory extends Factory
{
    protected $model = \App\Models\Trip::class;

    public function definition()
    {
        $cities = [
            'Jakarta',
            'Surabaya',
            'Bandung',
            'Medan',
            'Makassar',
            'Yogyakarta',
            'Semarang',
            'Balikpapan',
            'Denpasar',
            'Palembang'
        ];

        return [
            'truck_id' => Truck::factory(),
            'driver_id' => Driver::factory(),
            'start_location' => $this->faker->randomElement($cities),
            'end_location' => $this->faker->randomElement($cities),
            'distance' => $this->faker->randomFloat(2, 50, 1000),
            'trip_date' => $this->faker->dateTimeBetween('first day of this month', 'last day of this month')->format('Y-m-d'),
        ];
    }
}
