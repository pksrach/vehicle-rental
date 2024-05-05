<?php

namespace Database\Factories;

use App\Models\Booked;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookedDetail>
 */
class BookedDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicle = Vehicle::factory()->create();

        return [
            'booked_id' => function () {
                return Booked::factory()->create()->id;
            },
            'vehicle_id' => $vehicle->id,
            'service_price' => $vehicle->price,
            'discount' => $this->faker->randomFloat(2, 0, 50)
        ];
    }
}
