<?php

namespace Database\Seeders;

use App\Models\Agreement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agreement::factory()->count(20)->create();
    }
}
