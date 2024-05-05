<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        $vehicleNames = [
            'Zoomer 2022', 'Zoomer 2023', 'Honda Dream 18', 'Honda Dream 22', 'Suzuki Swift', 'BMW X5', 'Toyota Camry',
            'Suzuki Hayabusa', 'Honda CR-V', 'Zoomer X', 'BMW M3', 'Toyota RAV4', 'Honda Civic', 'Suzuki V-Strom',
            'Suzuki GSX-R1000', 'Honda Accord', 'Zoomer X 125', 'BMW X7', 'Toyota Highlander', 'Honda CR-Z',
            'Suzuki Boulevard M109R', 'Honda Fit', 'Zoomer X 150', 'BMW 3 Series', 'Toyota Corolla', 'Honda HR-V',
            'Suzuki GSX-S1000', 'Honda Insight', 'Zoomer X 200', 'BMW 5 Series', 'Toyota Avalon', 'Honda Jazz',
            'Suzuki DR-Z400S', 'Honda Odyssey', 'Zoomer X 250', 'BMW 7 Series', 'Toyota Prius', 'Honda Pilot',
            'Suzuki DR200S', 'Honda Passport', 'Zoomer X 300', 'BMW X3', 'Toyota Sienna', 'Honda Ridgeline'
        ];

        return [
            'brand_id' => random_int(1, 7),
            'category_id' => random_int(1, 4),
            'location_id' => random_int(1, 10),
            'name' => $this->faker->randomElement($vehicleNames),
            'description' => $this->faker->text(50),
            'attachment' => null,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'is_active' => true,
        ];
    }
}
