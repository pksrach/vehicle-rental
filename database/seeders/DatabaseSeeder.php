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
//        \App\Models\User::factory(15)->create();

        $customerUsers = \App\Models\User::factory(10)->state(['user_type' => 1])->create();
        $staffUsers = \App\Models\User::factory(10)->state(['user_type' => 2])->create();

        \App\Models\Customer::factory(10)->state([
            'user_id' => function () use ($customerUsers) {
                return $customerUsers->pop()->id;
            },
        ])->create();

        \App\Models\Staff::factory(10)->state([
            'user_id' => function () use ($staffUsers) {
                return $staffUsers->pop()->id;
            },
        ])->create();

        \App\Models\Brand::factory(7)->create();
        \App\Models\Category::factory(4)->create();
        \App\Models\Location::factory(10)->create();
        \App\Models\Vehicle::factory(30)->create();
    }
}
