<?php

namespace Database\Seeders;

use App\Models\Stores;
use Illuminate\Database\Seeder;

class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stores::factory(random_int(5,10))->create();
    }
}
