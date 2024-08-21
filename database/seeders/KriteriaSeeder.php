<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create some sample data for the Kriteria model
        $kriteria = [
            [
                'nama_kriteria' => 'Kuantitas',
            ],
            [
                'nama_kriteria' => 'Jumlah Pembeli',
            ],
            [
                'nama_kriteria' => 'Omset',
            ],
        ];

        // Loop through the data and create Kriteria records
        foreach ($kriteria as $data) {
            Kriteria::create($data);
        }
    }
}
