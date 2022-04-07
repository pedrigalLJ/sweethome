<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentVerificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'agent_id'=> $this->faker->unique()->numberBetween(1,15),
            'birthdate' => $this->faker->dateTimeBetween('1972-01-01', '1997-12-31')->format('Y-m-d'),
            'license_no' => $this->faker->numerify('agent-####'),
            'id_picture' => $this->faker->image('public/storage/agent-id-pictures',640,480, null, false),
        ];
    }
}
