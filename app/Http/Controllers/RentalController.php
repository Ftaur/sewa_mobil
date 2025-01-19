<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;

class RentalController extends Controller
{
    public function create()
    {
        $availableCars = Car::where('available', true)->where('user_id', '!=', auth()->id())->get();
        return view('rentals.create', compact('availableCars'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $car = Car::find($validatedData['car_id']);
        if (!$car->available || $car->user_id == auth()->id()) {
            return redirect()->back()->with('error', 'You cannot rent your own car or the car is not available.');
        }

        $rental = new Rental();
        $rental->user_id = auth()->id();
        $rental->license_plate = $car->license_plate;
        $rental->start_date = $validatedData['start_date'];
        $rental->end_date = $validatedData['end_date'];
        $rental->save();

        $car->available = false;
        $car->save();

        return redirect()->route('rental.index');
    }

    public function index()
    {
        $rentals = Rental::with('car')->where('user_id', auth()->id())->get();
        // dd($rentals);
        return view('rentals.index', compact('rentals'));
    }
}
