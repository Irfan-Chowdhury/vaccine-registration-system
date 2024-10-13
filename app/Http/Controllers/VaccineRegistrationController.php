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
        // date_default_timezone_set(env('APP_TIMEZONE'));

        // // $users = User::select('id','name','email','scheduled_date','vaccine_center_id')->with('vaccineCenter:id,name,address')->whereDate('scheduled_date', '=', Carbon::tomorrow()->toDateString())->get();
        // // foreach ($users as $user) {
        // //     $scheduleDate = $user->scheduled_date;
        // //     $centerName = $user->vaccineCenter->name;
        // //     $centerAddress = $user->vaccineCenter->address;

        // //     // $user->notify(new VaccineReminderNotification($user->name, $scheduleDate, $centerName, $centerAddress));

        // //     dispatch(new SendVaccineReminderJob($user, $scheduleDate, $centerName, $centerAddress));
        // // }

        // return User::select('id','name','email','scheduled_date','vaccine_center_id', function ($query) {
        //     $query->whereDate('scheduled_date', '=', Carbon::tomorrow()->toDateString());
        // })->each(function ($user) {
        //     return $user->scheduled_date;
        //     // Dispatch the job to the queue
        //     // SendVaccineReminderJob::dispatch($user, $user->registration->scheduled_date)
        //     //     ->onQueue('emails');
        // });

        // dd('Sent');



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
