<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function searchPage()
    {
        return view('pages.search');
    }

    public function searchProcess(SearchRequest $request, SearchService $searchService)
    {
        $userData = $searchService->show($request->nid);

        $scheduledDate = isset($userData) ? $userData->scheduled_date : null;

        $isExitstsData = isset($userData) ? true : false;

        $vaccineStatus = $searchService->getVaccineStatus($isExitstsData, $scheduledDate);

        return view('pages.search', compact('userData', 'vaccineStatus'));
    }
}
