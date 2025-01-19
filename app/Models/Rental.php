<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_plate',
        'start_date',
        'end_date'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'license_plate', 'license_plate');
    }

    public function carReturn()
    {
        return $this->hasOne(CarReturn::class);
    }
}
