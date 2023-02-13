<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use  App\Models\Product;
use  App\Models\Order;
class ProductFactory extends Factory
{
    /**
 * The name of the factory's corresponding model.
 *
 * @var string
 */
protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2),
            'order_id' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
