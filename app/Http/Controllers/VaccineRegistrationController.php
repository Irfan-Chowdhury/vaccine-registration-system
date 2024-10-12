<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineRegistrationRequest;
use App\Models\User;
use App\Models\VaccinationSchedule;
use App\Services\RegistrationService;
use App\Traits\MessageTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccineRegistrationController extends Controller
{
    use MessageTrait;

    public function create(RegistrationService $registrationService)
    {
        $vaccineCenters = $registrationService->getAllVaccineCenterData();

        return view('pages.registration.create', compact('vaccineCenters'));
    }

    public function store(VaccineRegistrationRequest $request, RegistrationService $registrationService)
    {
        DB::beginTransaction();
        try {
            $registrationService->registrationProcess($request);

            DB::commit();

            $this->setSuccessMessage('Successfully Data Saved');

            return redirect()->back();

        } catch (Exception $e) {
            DB::rollBack();
            $this->setErrorMessage($e->getMessage());

            return redirect()->back();
        }
    }
}
