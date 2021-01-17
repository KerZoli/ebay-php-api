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
        $ebayService = $service->getEbaySearchService();

        if ($request->get('price_min')) {
            $ebayService->setFilter($request->get('price_min'),'>');
        }

        if ($request->get('price_max')) {
            $ebayService->setFilter($request->get('price_max'),'<');
        }

        if ($request->get('sorting') && $request->get('sorting') !== 'default') {
            $ebayService->setSort($request->get('sorting'));
        }

        if (!$request->get('keywords')) {
            throw new Exception('Keyword is missing. Please provide a keyword.');
        }

        $ebayService->findItemsByKeyword($request->get('keywords'));

        return response()->json($service->getEbaySearchService()->getFeed()->getResults());
    }
}
