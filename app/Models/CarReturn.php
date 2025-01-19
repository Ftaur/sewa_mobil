<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'fee'
    ];

    // public function car()
    // {
    //     return $this->belongsTo(Car::class);
    // }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
