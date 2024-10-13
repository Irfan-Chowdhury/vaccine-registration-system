<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SearchService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(SearchService $searchService)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->vaccine_status = $searchService->getVaccineStatus($user);
        }

        return view('pages.users.index', compact('users'));

    }
}
