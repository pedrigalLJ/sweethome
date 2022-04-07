<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'agent_id'=> rand(1,15),
            'title' => $this->faker->sentence(),
            'category' => $this->faker->randomElement(['apartment', 'condo', 'house']),
            'type'=> $this->faker->randomElement(['sale', 'rent']),
            'bathroom' => rand(1,2),
            'bedroom' => rand(1,5),
            'street_brgy' => $this->faker->streetAddress(),
            'city' => 'Cebu City',
            'province' => 'Cebu',
            'featured_image' => $this->faker->image('public/storage/properties',640,480, null, false),
            'price' => $this->faker->randomFloat(2, 0, 100000),
            'status' => '1',
            'description'=> $this->faker->paragraph(),
            'avail_days'=> json_encode($this->faker->randomElements(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], 3)),
            'avail_times'=> json_encode($this->faker->randomElements(['08:00', '09:00', '10:00', '11:00','13:00', '14:00', '15:00', '16:00'], 5)),
        ];
    }
}
