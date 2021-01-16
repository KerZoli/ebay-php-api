<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @throws Exception
     */
    public function __invoke(Request $request, SearchService $service): JsonResponse
    {
        $service->getEbaySearchService()
            ->setPriceFilter(100, '>')
            ->setPriceFilter(800, '<')
            ->setSort('by_price_asc')
            ->findItemsByKeyword($request->get('keywords'));

        return response()->json($service->getEbaySearchService()->getFeed()->getResults());
    }
}
