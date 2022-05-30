<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => strtoupper($this->faker->text),
            'description' => $this->faker->text,
//            'count' => random_int(0,10)
        ];
    }
}
