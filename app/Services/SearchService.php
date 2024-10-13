<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class SearchService
{
    public function show(string $nid): object | null
    {
        return User::select('id','name','email','nid','vaccine_status','scheduled_date','vaccine_center_id')
                    ->with('vaccineCenter:id,name')
                    ->where('nid', $nid)->first();
    }

    public function getVaccineStatus(object|null $userData) : string
    {
        if(!$userData)
            return 'Not registered';

        $scheduledDate = Carbon::parse($userData->scheduled_date);
        $currentDate = Carbon::now();

        if (!$userData->scheduled_date)
            return 'Not scheduled';
        elseif ($userData->scheduled_date && $scheduledDate->lt($currentDate))
            return 'Vaccinated';

        return 'Scheduled';
    }
}






