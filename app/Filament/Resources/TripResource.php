<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Models\Driver;
use App\Models\Truck;
use App\Models\Trip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('truck_id')
                    ->label('Truck')
                    ->options(Truck::all()->pluck('model', 'id'))
                    ->required()
                    ->reactive(),

                Forms\Components\Select::make('driver_id')
                    ->label('Driver')
                    ->options(Driver::all()->pluck('name', 'id'))
                    ->required()
                    ->reactive(),

                Forms\Components\TextInput::make('start_location')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('end_location')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('distance')
                    ->required()
                    ->numeric(),

                Forms\Components\DatePicker::make('trip_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('truck.license_plate')
                    ->label('Truck')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('driver.name')
                    ->label('Driver')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_location')
                    ->searchable(),

                Tables\Columns\TextColumn::make('end_location')
                    ->searchable(),

                Tables\Columns\TextColumn::make('distance')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('trip_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // You can add relations if needed, e.g., if you want to show related data
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}
