<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use  App\Models\Product;
use  App\Models\Order;
class ProductOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' =>Product::factory(),
            'product_id'=>Order::factory(),
            'count'=> $this->faker->numberBetween(1, 100),
        ];
    }
}
