<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agreement>
 */
class AgreementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = array("sarpras", 'lainnya', 'sewa bangunan', 'sewa kendaraan', 'upp', 'tuks tersus');
        $numbers = array(20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40);
        $k = array_rand($items);
        $i = array_rand($numbers);

        return [
            'id' => Uuid::uuid4(),
            'title' => "Perjanjian Kerjasama antara PT Pelindo Jasa Maritim dengan PT Abdi Sarana Nusa tentang  pelaksanaan penundaan kapal di DLKR dan DLKP Pelabuhan Bula",
            'agreementNumber' => fake()->uuid(),
            'agreementType' => $items[$k],
            'partner' => 'PT Abdi Sarana Nusa Marine',
            'unit' => 'BULA',
            'signDate' => now(),
            'startDate' => now()->addDay(),
            'endDate' => now()->addMonth(),
            'fileName' => 'files/perjanjian/sarpras/1695957354_PETUNJUK WRITEUP.pdf',
        ];
    }
}
