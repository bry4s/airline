<?php

namespace Database\Factories;

use App\Models\TripStaff;
use App\Models\Staff;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripStaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TripStaff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'staff_id' => Staff::factory(),
            'trip_id' => Trip::factory(),
        ];
    }
}
