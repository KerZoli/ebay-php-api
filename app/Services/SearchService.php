<?php

namespace App\Services;

use App\Services\Feed\EbaySearchService;

class SearchService
{
    private $ebaySearchService;

    public function __construct(EbaySearchService $ebaySearchService)
    {
        $this->ebaySearchService = $ebaySearchService;
    }

    public function getEbaySearchService(): EbaySearchService
    {
        return $this->ebaySearchService;
    }
}

