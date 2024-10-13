<?php

namespace App\Http\Controllers;

use App\Services\RegistrationService;
use Illuminate\Support\Facades\Cache;

class VaccineCenterController extends Controller
{
    public function index(RegistrationService $registrationService)
    {
        $vaccineCenters = Cache::remember('vaccineCenters', 3600, function () use ($registrationService) {
            return $registrationService->getAllVaccineCenterData();
        });

        return view('pages.vaccine_centers', compact('vaccineCenters'));
    }
}
