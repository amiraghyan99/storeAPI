<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
//         \App\Models\User::factory(10)->create();
        User::factory(10)->has(Store::factory(random_int(5,10))->has(Product::factory(5)))->create();
    }
}
