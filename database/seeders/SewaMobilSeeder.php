<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Car;
use App\Models\Rental;
use App\Models\CarReturn;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SewaMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\User::factory(10)->create()->each(function ($user) {
            // Create user details
            UserDetail::create([
                'user_id' => $user->id,
                'full_name' => fake()->name(),
                'address' => fake()->address(),
                'phone_number' => fake()->phoneNumber(),
                'driver_license_number' => fake()->numerify('DL-#####'),
            ]);

            // Create cars
            for ($i = 0; $i < 2; $i++) {
                $car = Car::create([
                    'brand' => fake()->company(),
                    'model' => fake()->word(),
                    'license_plate' => fake()->unique()->bothify('###-####'),
                    'user_id' => $user->id,
                    'rental_price' => fake()->numberBetween(50, 300),
                    'available' => fake()->boolean(80),
                ]);

                // Create rentals
                $rental = Rental::create([
                    'user_id' => $user->id,
                    'license_plate' => $car->license_plate,
                    'start_date' => Carbon::now()->subDays(fake()->numberBetween(1, 10)),
                    'end_date' => Carbon::now()->addDays(fake()->numberBetween(1, 10)),
                    'status' => fake()->boolean(50),
                ]);

                // Create car returns if rental is completed
                if ($rental->status) {
                    CarReturn::create([
                        'rental_id' => $rental->id,
                        'fee' => $car->rental_price * fake()->numberBetween(1, 7),
                    ]);
                }
            }
        });
    }
}
