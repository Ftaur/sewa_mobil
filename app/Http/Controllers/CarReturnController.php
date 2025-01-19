<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;
use App\Models\CarReturn;
use Carbon\Carbon;

class CarReturnController extends Controller
{
    public function create()
    {
        // Get user rentals where the status is false (not returned)
        $userRentals = Rental::with('car')
            ->where('user_id', auth()->id())
            ->where('status', false)
            ->get();

        return view('returns.create', compact('userRentals'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rental_id' => 'required|exists:rentals,id',
        ]);

        // dd($validatedData);

        $rental = Rental::find($validatedData['rental_id']);
        if ($rental->status) {
            return redirect()->back()->withErrors('This car has already been returned.');
        }

        $car = Car::where('license_plate', $rental->license_plate)->first();

        $startDate = Carbon::parse($rental->start_date);
        $endDate = Carbon::parse($rental->end_date);
        $daysRented = $startDate->diffInDays($endDate);

        $carReturn = new CarReturn();
        $carReturn->user_id = auth()->id();
        $carReturn->rental_id = $rental->id;
        $carReturn->license_plate = $car->license_plate;
        $carReturn->fee = $car->rental_price * $daysRented;
        $carReturn->save();

        $rental->status = true;
        $rental->save();

        $car->available = true;
        $car->save();

        return redirect()->route('return.index');
    }

    public function index()
    {
        $returns = CarReturn::where('user_id', auth()->id())->get();
        return view('returns.index', compact('returns'));
    }
}
