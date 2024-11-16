<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    public function index(Request $request)
    {
        $trips = Trip::with(['truck', 'driver'])
            ->get()
            ->map(function ($trip) {
                return [
                    'trip_id' => $trip->id,
                    'truck' => [
                        'license_plate' => $trip->truck->license_plate,
                        'model' => $trip->truck->model,
                    ],
                    'driver' => [
                        'name' => $trip->driver->name,
                    ],
                    'start_location' => $trip->start_location,
                    'end_location' => $trip->end_location,
                    'distance' => $trip->distance,
                    'trip_date' => $trip->trip_date,
                    'created_at' => $trip->created_at,
                    'updated_at' => $trip->updated_at,
                ];
            });

        return response()->json($trips);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'truck_id' => 'required|exists:trucks,id',
            'driver_id' => 'required|exists:drivers,id',
            'start_location' => 'required|string',
            'end_location' => 'required|string',
            'distance' => 'required|numeric|min:1',
            'trip_date' => 'required|date',
        ], [
            'truck_id.exists' => 'The selected truck is invalid.',
            'driver_id.exists' => 'The selected driver is invalid.',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $trip = Trip::create($request->all());
        return response()->json([
            'message' => 'Trip created successfully!',
            'trip' => $trip
        ], 201);
    }

}
