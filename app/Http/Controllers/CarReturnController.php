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
        // $userRentals = Rental::with('car')
        //     ->where('user_id', auth()->id())
        //     ->where('status', false)
        //     ->get();

        return view('returns.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'license_plate' => 'required|string',
        ]);

        // dd($validatedData);

        $rental = Rental::where('license_plate', $validatedData['license_plate'])
        ->where('status', false)
        ->where('user_id', auth()->id())
        ->first();

        // dd($rental);

        if ($rental == null) {
            return redirect()->back()->with('error', 'Tidak ada rental yang aktif untuk nomer plat ini.');
        }

        $startDate = Carbon::parse($rental->start_date);
        $endDate = Carbon::parse($rental->end_date);
        $daysRented = $startDate->diffInDays($endDate);

        $car = Car::where('license_plate', $rental->license_plate)->first();
        $fee = $car->rental_price * $daysRented;

        CarReturn::create([
            'rental_id' => $rental->id,
            'fee' => $fee,
        ]);

        $rental->status = true;
        $rental->save();

        $car->available = true;
        $car->save();

        return redirect()->route('return.index');
    }

    public function index()
    {
        $returns = CarReturn::with('rental.car')
        ->whereHas('rental', function($query) {
            $query->where('user_id', auth()->id());
        })
        ->get();
        return view('returns.index', compact('returns'));
    }
}
