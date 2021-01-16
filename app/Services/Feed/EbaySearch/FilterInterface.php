<?php

namespace App\Services\Feed\EbaySearch;

interface FilterInterface
{
    public function getItemFilters(): array;
}
