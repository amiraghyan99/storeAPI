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
            ['name' => 'synthetic'],
            ['name' => 'cotton'],
            ['name' => 'polyethylene'],
        ];

        Material::insert($materials);
    }
}
