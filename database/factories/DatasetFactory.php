<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Dataset;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dataset>
 */
class DatasetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dataset::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'desain' => $this->faker->numerify('Desain-##'),
            'jumlah_terjual' => $this->faker->numberBetween(1, 500),
            'jumlah_pembeli' => $this->faker->numberBetween(1, 50),
            'omset' => $this->faker->numberBetween(4000000, 10000000),
        ];
    }
}
