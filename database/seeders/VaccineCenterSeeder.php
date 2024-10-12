<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineCenterSeeder extends Seeder
{
    //php artisan db:seed --class=VaccineCenterSeeder
    public function run(): void
    {
        VaccineCenter::factory()
            ->count(50)
            ->create();
    }
}
