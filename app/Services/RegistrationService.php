<?php

namespace App\Services;

use App\Models\User;
use App\Models\VaccinationSchedule;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    public function getAllVaccineCenterData(): Collection
    {
        return VaccineCenter::select('id', 'name', 'address', 'daily_limit')->get();
    }

    public function getNextAvailableDate(string $lastScheduleDate)
    {
        $date = Carbon::parse($lastScheduleDate);
        $nextDate = $date->addDay()->toDateString();

        if ($date->isFriday() || $date->isSaturday()) {
            // Move to the next Sunday
            $nextDate = $date->next(Carbon::SUNDAY)->toDateString();
        }

        return $nextDate;
    }

    public function getScheduleDate(int $vaccineCenterId): string|null
    {
        $vaccinationSchedules = VaccinationSchedule::select('scheduled_date', 'users_count')->where('vaccine_center_id', $vaccineCenterId);

        $singleVaccineCenter = VaccineCenter::find($vaccineCenterId);

        $scheduledDate = null;
        foreach ($vaccinationSchedules->get() as $item) {
            if ($item->users_count < $singleVaccineCenter->daily_limit) {
                $scheduledDate = $item->scheduled_date;
                break;
            }
        }

        if (!$scheduledDate) {
            $lastVaccinationSchedule = $vaccinationSchedules->latest()->first();
            if(!$lastVaccinationSchedule) {
                return null;
            }
            $lastScheduledDate = $lastVaccinationSchedule->scheduled_date;
            $scheduledDate = self::getNextAvailableDate($lastScheduledDate);
        }

        return $scheduledDate;
    }

    public function registrationProcess(object $request)
    {
        $data = $request->validated();

        $data['scheduled_date'] = $this->getScheduleDate($request->vaccine_center_id);
        $data['vaccine_status'] = 'Scheduled';

        User::create($data);

        VaccinationSchedule::updateOrCreate(
            [
                'vaccine_center_id' => $data['vaccine_center_id'],
                'scheduled_date' => $data['scheduled_date'],
            ],
            [
                'users_count' => DB::raw('users_count + 1'),
            ]
        );
    }
}
