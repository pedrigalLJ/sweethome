<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgentVerification;

class AgentVerificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AgentVerification::factory(15)->create();
    }
}
