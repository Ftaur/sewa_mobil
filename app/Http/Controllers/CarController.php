<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{

    public function index()
    {
        // $cars = Car::where('user_id', auth()->id())->get();
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    // Show the form for creating a new car
    public function create()
    {
        return view('cars.create');
    }

    // Store a newly created car in storage
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        // dd($request);

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars',
            'user_id' => 'required',
            'rental_price' => 'required|numeric',
        ]);

        Car::create($request->all());

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    // Display the specified car
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // Show the form for editing the specified car
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Update the specified car in storage
    public function update(Request $request, Car $car)
    {
        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars,license_plate,' . $car->id,
            'rental_price' => 'required|numeric',
        ]);

        $car->update($validatedData);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    // Remove the specified car from storage
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
