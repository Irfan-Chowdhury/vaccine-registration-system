<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\RegistrationService;
use App\Services\SearchService;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        $registrationService = app(RegistrationService::class);
        $searchService = app(SearchService::class);

        User::factory()
            ->count(10)
            ->withServices($registrationService, $searchService)
            ->create();
    }
}
