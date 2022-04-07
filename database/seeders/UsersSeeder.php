<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()
                ->count(15)
                ->state(
                    ['role_id' => 1],
                )
                ->create();
        
        $users = User::factory()
                ->count(100)
                ->state(
                    ['role_id' => 2 ],
                )
                ->create();
    }
}
