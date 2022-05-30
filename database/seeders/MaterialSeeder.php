<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            ['material' => 'XS'],
            ['material' => 'S'],
            ['material' => 'M'],
            ['material' => 'L'],
            ['material' => 'XL'],
            ['material' => 'XXL']
        ];

        Material::insert($materials);
    }
}
