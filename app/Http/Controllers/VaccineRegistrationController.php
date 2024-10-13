<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineRegistrationRequest;
use App\Jobs\SendVaccineReminderJob;
use App\Models\User;
use App\Notifications\VaccineReminderNotification;
use App\Services\RegistrationService;
use App\Services\VaccinationScheduleService;
use App\Traits\MessageTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class VaccineRegistrationController extends Controller
{
    use MessageTrait;

    public function create(RegistrationService $registrationService, VaccinationScheduleService $vaccinationScheduleService)
    {
        $vaccinationScheduleService->schedules();

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
