<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Desain;

class DesainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Make a loop of # amount of Desain with the 'nama_desain' is 'Desain #'
        for ($i = 1; $i <= 20; $i++) {
            Desain::create([
                'nama_desain' => 'Desain ' . $i,
            ]);
        }
    }
}
