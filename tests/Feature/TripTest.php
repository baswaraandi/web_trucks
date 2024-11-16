<?php

namespace Tests\Feature;

use App\Models\Trip;
use App\Models\Truck;
use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TripTest extends TestCase
{
    // use RefreshDatabase;

    public function test_trip_can_be_created_successfully()
    {
        $truck = Truck::factory()->create();
        $driver = Driver::factory()->create();

        $trip = Trip::create([
            'truck_id' => $truck->id,
            'driver_id' => $driver->id,
            'start_location' => 'Jakarta',
            'end_location' => 'Surabaya',
            'distance' => 100,
            'trip_date' => now(),
        ]);

        $this->assertDatabaseHas('trips', [
            'truck_id' => $truck->id,
            'driver_id' => $driver->id,
            'start_location' => 'Jakarta',
            'end_location' => 'Surabaya',
            'distance' => 100,
        ]);

        $this->assertInstanceOf(Trip::class, $trip);
    }

    public function test_trip_creation_fails_if_truck_id_is_invalid()
    {
        $driver = Driver::factory()->create();
        // dd($driver);

        $response = $this->postJson('/api/trip', [
            'truck_id' => 999,
            'driver_id' => $driver->id,
            'start_location' => 'Jakarta',
            'end_location' => 'Surabaya',
            'distance' => 100,
            'trip_date' => now(),
        ]);
        // dd($response->getContent());
        // $response->dump();
        $response->assertStatus(422);
        $response->assertJson([
            'truck_id' => ['The selected truck is invalid.']
        ]);
    }

    public function test_trip_creation_fails_if_driver_id_is_invalid()
    {
        $truck = Truck::factory()->create();

        $response = $this->postJson('/api/trip', [
            'truck_id' => $truck->id,
            'driver_id' => 999,
            'start_location' => 'Jakarta',
            'end_location' => 'Surabaya',
            'distance' => 100,
            'trip_date' => now(),
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'driver_id' => ['The selected driver is invalid.']
        ]);
    }
}
