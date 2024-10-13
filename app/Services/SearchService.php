<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class SearchService
{
    public function show(string $nid): ?object
    {
        return User::select('id', 'name', 'email', 'nid', 'vaccine_status', 'scheduled_date', 'vaccine_center_id')
            ->with('vaccineCenter:id,name')
            ->where('nid', $nid)->first();
    }

    public function getVaccineStatus(bool $isExitstsData, string|null $scheduledDate): string
    {
        if (! $isExitstsData) {
            return 'Not registered';
        }

        $scheduledDate = $scheduledDate ? Carbon::parse($scheduledDate) : null;
        $currentDate = Carbon::now();

        if ($isExitstsData && ! $scheduledDate) {
            return 'Not scheduled';
        } elseif ($scheduledDate && $scheduledDate->lt($currentDate)) {
            return 'Vaccinated';
        }

        return 'Scheduled';
    }
}
