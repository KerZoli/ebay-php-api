<?php

namespace App\FeedEntities;

use App\Product;
use stdClass;

class EbayFeed implements FeedInterface
{
    public const PROVIDER = 'ebay';

    private $products = [];

    public function add(stdClass $ProductItem): void
    {
        $Product = new Product();
        $Product->setProvider(self::PROVIDER);
        $Product->setItemId($ProductItem->itemId[0] ?? null);
        $Product->setPrice($ProductItem->sellingStatus[0]->currentPrice[0]->{'__value__'} ?? null);
        $Product->setPriceCurrency($ProductItem->sellingStatus[0]->currentPrice[0]->{'@currencyId'} ?? null);
        $Product->setTitle($ProductItem->title[0] ?? null);
        $Product->setClickOutLink($ProductItem->viewItemURL[0] ?? null);
        $Product->setMainPhotoUrl($ProductItem->galleryURL[0] ?? null);
        $Product->setShippingPrice($ProductItem->shippingInfo[0]->shippingServiceCost[0]->{'__value__'} ?? null);
        $Product->setValidUntil($ProductItem->listingInfo[0]->endTime[0] ?? null);
        $this->products[] = $Product;
    }

    public function getResults(): array
    {
        return $this->products;
    }
}
