<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'card_identify' => $this->faker->creditCardNumber,
            'attachment' => $this->faker->imageUrl(),
            'is_active' => 1,
            'user_id' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
