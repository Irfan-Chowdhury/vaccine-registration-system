<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SearchService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(SearchService $searchService)
    {
        $users = User::select('id','nid','name','email','gender','scheduled_date','vaccine_status')->get();
        foreach ($users as $user) {
            $user->vaccine_status = $searchService->getVaccineStatus(true, $user->scheduled_date);
        }

        return view('pages.users.index', compact('users'));
    }
}
