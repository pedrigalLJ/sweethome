<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminAccountSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AgentVerificationSeeder;
use Database\Seeders\PropertySeeder;
use Database\Seeders\RoleUserSeeder;
use Database\Seeders\UsersSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminAccountSeeder::class,
            AgentVerificationSeeder::class,
            PropertySeeder::class,
            RoleSeeder::class,
            RoleUserSeeder::class,
            UsersSeeder::class,

        ]);

    
    }
}
