<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booked>
 */
class BookedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'pickup_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'complete_date' => $this->faker->dateTimeBetween('+1 month', '+2 month'),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'customer_id' => \App\Models\Customer::factory(),
            'staff_id' => \App\Models\Staff::factory(),
            'payment_method_id' => \App\Models\PaymentMethod::factory(),
        ];
    }
}
