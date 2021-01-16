<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request, SearchService $service)
    {
        //
        $service->getEbaySearchService()->findItemsByKeyword($request->get('keywords'));

        return $service->getEbaySearchService()->getFeed()->getResults();
    }
}
