<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // User generate
        $customerUsers = \App\Models\User::factory(10)->state(['user_type' => 1])->create();
        $staffUsers = \App\Models\User::factory(10)->state(['user_type' => 2])->create();
        $customers = \App\Models\Customer::factory(10)->state([
            'user_id' => function () use ($customerUsers) {
                return $customerUsers->pop()->id;
            },
        ])->create();
        $staffs = \App\Models\Staff::factory(10)->state([
            'user_id' => function () use ($staffUsers) {
                return $staffUsers->pop()->id;
            },
        ])->create();

        // Item generate
        \App\Models\Brand::factory(7)->create();
        \App\Models\Category::factory(4)->create();
        \App\Models\Location::factory(10)->create();
        \App\Models\Vehicle::factory(30)->create();

        // Booking generate
        $paymentMethods = \App\Models\PaymentMethod::factory(5)->create();

        // Create Booked instances with the created Customer, Staff, and PaymentMethod instances
        $bookeds = \App\Models\Booked::factory(15)->state([
            'customer_id' => function () use ($customers) {
                return $customers->random()->id;
            },
            'staff_id' => function () use ($staffs) {
                return $staffs->random()->id;
            },
            'payment_method_id' => function () use ($paymentMethods) {
                return $paymentMethods->random()->id;
            },
        ])->create();

        foreach ($bookeds as $booked) {
            \App\Models\BookedDetail::factory()->state([
                'booked_id' => $booked->id,
            ])->create();
        }
    }
}
