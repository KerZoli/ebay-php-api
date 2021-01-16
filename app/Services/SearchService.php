<?php

namespace App\Services;

class SearchService
{
    private $services = [];
    private $results = [];

    public function __construct(array $searchServices)
    {
        $this->services = $searchServices;
    }

    public function search(string $keyword)
    {
        foreach ($this->services as $service) {
            $service->findItemsByKeyword($keyword);
        }
    }

    public function getProducts()
    {
        $
    }

    public function getProductsByFeed()
    {
        foreach ($th)
    }
}

