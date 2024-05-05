<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $payment_name = ['Cash', 'ABA', 'ACLEDA', 'Chip Mong', 'Wing'];
        $account_name = ['Sokha', 'Sovann', 'Sok', 'Sovanna', 'Sokheng'];
        return [
            'payment_name' => $this->faker->unique()->randomElement($payment_name),
            'account_name' => $this->faker->unique()->randomElement($account_name),
            'account_number' => $this->faker->randomNumber(9),
            'links' => $this->faker->url,
            'is_active' => 1,
        ];
    }
}
