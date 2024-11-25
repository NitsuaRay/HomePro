<?php

namespace Database\Seeders;

use App\Models\Barangay;
use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Database\Seeder;

class BarangaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pangasinan = Province::where('name', 'Pangasinan')->first();
        $municipalities = [
            'Asingan' => [
                'Ariston Este',
                'Ariston West',
                'Bantog',
                'Baro',
                'Bobonan',
                'Cabalitian',
                'Carosucan Norte',
                'Carosucan Sur',
                'Coldit',
                'Domanpot',
                'Dupac',
                'Macalong',
                'Poblacion East',
                'Poblacion West',
                'San Carlos',
                'San Vicente Este',
                'San Vicente West',
                'Santa Maria West',
                'Sobol',
                'Suaco'
            ],
            'Villasis' => [
                // Add barangays for Villasis here
                'Barangay 1',
                'Barangay 2',
                'Barangay 3',
                // Add more barangays as needed
            ],
            // Add more municipalities and their respective barangays here
        ];

        foreach ($municipalities as $municipalityName => $barangays) {
            $municipality = Municipality::firstOrCreate([
                'name' => $municipalityName,
                'province_id' => $pangasinan->id,
            ]);

            foreach ($barangays as $barangay) {
                Barangay::create([
                    'name' => $barangay,
                    'municipality_id' => $municipality->id,
                ]);
            }
        }
    }
}
