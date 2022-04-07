<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $properties = Property::factory()
        ->count(25)
        ->state(
            ['category' => 'apartment' ],
        )
        ->create();

        $properties = Property::factory()
        ->count(50)
        ->state(
            ['category' => 'condo' ],
        )
        ->create();

        $properties = Property::factory()
        ->count(25)
        ->state(
            ['category' => 'house' ],
        )
        ->create();
    }
}
