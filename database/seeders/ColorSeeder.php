<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            ['name' => 'black'],
            ['name' => 'white'],
            ['name' => 'gray'],
            ['name' => 'red'],
            ['name' => 'purple'],
            ['name' => 'blue'],
            ['name' => 'yellow']
        ];

        Color::insert($colors);
    }
}
