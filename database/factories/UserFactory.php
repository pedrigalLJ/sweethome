<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'role_id'=> rand(1,2),
            'username' => $this->faker->unique()->userName(),
            'given_name' => $this->faker->lastName(),
            'last_name' => $this->faker->firstName(),
            'phone_no' => $this->faker->numerify('09########'),
            'city' => 'Cebu City',
            'province' => 'Cebu',
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'image' => $this->faker->image('public/storage/images',100,100, null, false),
            'about' => $this->faker->sentence(),
            'username' => $this->faker->userName(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'status' => '1',
            'remember_token' => Str::random(10),
            'trial_until' => \Carbon\Carbon::createFromTimeStamp($this->faker->dateTimeBetween('now', '+14 days')->getTimestamp())
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
