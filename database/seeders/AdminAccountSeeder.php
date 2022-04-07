<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
                'username'  => 'adminOnly',
                'password'  => bcrypt('verySecretPassword'),
                'created_at'    => now(),
        ]);
    }
}
