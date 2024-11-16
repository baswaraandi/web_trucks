<?php

namespace App\Filament\Widgets;

use App\Models\Trip;
use App\Models\Truck;
use App\Models\Driver;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
         $expiredKIR = Truck::where('exp_kir', '>=', now())->where('exp_kir', '<=', now()->addMonths(2))
         ->count();

         $expiredSIM = Driver::where('exp_sim', '>=', now())->where('exp_sim', '<=', now()->addMonths(2))
         ->count();
 
         $totalTrips = Trip::whereBetween('trip_date', ['2024-11-01', '2024-11-30'])->count();

         $totalTripsToday = Trip::whereDate('trip_date', today())->count();
 
         return [
             Stat::make('Total Trip Today', $totalTripsToday),
             Stat::make('Total Trip This Month', $totalTrips),
             Stat::make('Expired KIR', $expiredKIR)->description('KIR akan kedaluwarsa dalam 3 bulan ke depan'),
             Stat::make('Expired SIM', $expiredSIM)->description('SIM akan kedaluwarsa dalam 3 bulan ke depan'),
        ];
    }
}
