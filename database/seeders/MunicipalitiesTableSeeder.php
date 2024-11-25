<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pangasinan = Province::where('name', 'Pangasinan')->first();

        Municipality::create([
            'name' => 'Asingan',
            'province_id' => $pangasinan->id,
        ]);

        // Create Villasis municipality
        Municipality::create([
            'name' => 'Villasis',
            'province_id' => $pangasinan->id,
        ]);
    }
}
