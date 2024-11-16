<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $fillable = [
        'license_plate',
        'model',
        'capacity',
        'exp_kir',
        'status',
    ];
    
    public function trip()
    {
        return $this->hasMany(Trip::class);
    }
}
