<?php

namespace App\Services\Feed\EbaySearch;

class EbaySortOrder
{
    private const PRICE_PLUS_SHIPPING_HIGHEST = 'PricePlusShippingHighest';
    private const PRICE_PLUS_SHIPPING_LOWEST = 'PricePlusShippingLowest';

    private const SORT_MAPPER = [
        'by_price_asc' => self::PRICE_PLUS_SHIPPING_LOWEST,
        'by_price_desc' => self::PRICE_PLUS_SHIPPING_HIGHEST,
    ];

    public function getSortOrderByKey(string $key): ?string
    {
        if (!isset(self::SORT_MAPPER[$key])) {
            return null;
        }

        return self::SORT_MAPPER[$key];
    }
}
