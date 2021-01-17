<?php

namespace App\Services\Feed\EbaySearch\Filters;

use App\Services\Feed\EbaySearch\FilterInterface;

class PriceFilter implements FilterInterface
{
    private $value;
    private $currency;
    private $filterName;

    public function __construct(int $value, string $currency, string $filterName)
    {
        $this->value = $value;
        $this->currency = $currency;
        $this->filterName = $filterName;
    }

    public function getItemFilters(): array
    {
        $filters = [
            'name' => $this->filterName,
            'value' => $this->value,
        ];

        if ($this->currency) {
            $filters['paramName'] = 'Currency';
            $filters['paramValue'] = 'USD';
        }

        return $filters;
    }
}
