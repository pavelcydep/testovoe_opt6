<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'addres'=>$this->faker->address(),
            'data_order'=>$this->faker->date('d_m_Y'),
            'count'=> $this->faker->numberBetween(1, 1000),
            'summa'=> $this->faker->numberBetween(1, 100),
             //'point'=>$this->faker->localCoordinates(),
          ];
    }
}
