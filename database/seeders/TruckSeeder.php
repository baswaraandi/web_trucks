<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Truck;

class TruckSeeder extends Seeder
{
    public function run()
    {
        Truck::factory(10)->create();
    }
}
