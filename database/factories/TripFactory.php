<?php

namespace Database\Factories;

use App\Models\Trip;
use App\Models\Plane;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plane_id' => Plane::factory(),
            'from' => $this->faker->name(),
            'to' => $this->faker->name(),
            'price' => rand() * .0000001,
            'count' => rand() * .00000001,
            'departure' => rand() > 500000000 ? now()->addDays(1) : now()->subDays(1),
            'arrival' => now()->addMinutes(300),
        ];
    }
}
