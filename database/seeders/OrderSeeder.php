<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $products = Product::pluck('id')->toArray();

        for ($i = 1; $i <= 100; $i++) {
            Order::create([
                'full_name' => $faker->name(),
                'product_id' => $faker->randomElement($products),
                'product_amount' => rand(1, 500),
                'comment' => $faker->boolean(50) ? $faker->sentence() : null,
                'status' => $faker->randomElement(['new', 'completed']),
                'created_at' => Carbon::now()->subDays(rand(0, 30))->toDateString(),
            ]);
        }
    }
}
