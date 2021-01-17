<?php

namespace App\Services\Feed\EbaySearch\Filters;

use App\Services\Feed\EbaySearch\FilterInterface;

class FilterFactory
{
    public function make(float $value, string $condition, string $currency): FilterInterface
    {
        if ($condition === '<') {
           return new PriceFilter($value, $currency, 'MaxPrice');
        }

        return $this->filters[] = new PriceFilter($value, $currency, 'MinPrice');
    }
}
