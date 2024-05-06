<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = ['Phnom Penh', 'Battambang', 'Siem Reap', 'Sihanoukville', 'Kampong Cham', 'Ta Khmau', 'Pursat', 'Kampong Speu', 'Takeo', 'Kampot'];
        return [
            'name' => $this->faker->unique()->randomElement($locations),
            'parent_id' => null,
        ];
    }
}
