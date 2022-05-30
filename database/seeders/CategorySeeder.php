<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            ['name' => 'Laptop' ,'description' => 'Laptop'],
            ['name' => 'Car' ,'description' => 'Car'],
            ['name' => 'Phone' ,'description' => 'Phone'],
            ];

        Category::insert($colors);
    }
}
