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

        $vaccineStatus = $searchService->getVaccineStatus($userData);

        return view('pages.search', compact('userData','vaccineStatus'));
    }
}
