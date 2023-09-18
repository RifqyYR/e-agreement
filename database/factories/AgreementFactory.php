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
        $items = Array("sarpras", 'lainnya', 'sewa bangunan', 'sewa kendaraan', 'upp', 'tuks tersus');
        $k = array_rand($items);
        return [
            'id' => Uuid::uuid4(),
            'title' => "Perjanjian Kerjasama antara PT Pelindo Jasa Maritim dengan PT Abdi Sarana Nusa tentang  pelaksanaan penundaan kapal di DLKR dan DLKP Pelabuhan Bula",
            'agreementNumber' => 'IFE-SMA-SPM-AGR-AGR-2022-0002 dan HM.03.02/7/6/1/PGPR/RH4/REG4-22',
            'agreementType' => $items[$k],
            'partner' => 'PT Abdi Sarana Nusa Marine',
            'unit' => 'BULA',
            'signDate' => now(),
            'startDate' => now()->addDay(),
            'endDate' => now()->addMonth(),
            'fileName' => '20230911_SPK Pelindo Jasa Maritim dengan PT Abdi Sarana Nusa'
        ];
    }
}
