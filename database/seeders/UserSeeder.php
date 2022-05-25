<?php

namespace Database\Seeders;

use App\Models\Stores;
use App\Models\User;
use Database\Factories\StoresFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->has(Stores::factory(random_int(5,10)))->create();
    }
}
