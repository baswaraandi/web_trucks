<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'license_number',
        'exp_sim',
        'experience_years',
    ];
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
