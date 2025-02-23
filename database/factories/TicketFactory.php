<?php

namespace Database\Factories;

use App\Models\Ticket;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'trip_id' => rand() > 500000000 ? 1 : 3,
            'class' => rand() > 500000000 ? 1 : 3,
            'name' => $this->faker->name(),
            'seat' => Str::random(4),
        ];
    }
}
