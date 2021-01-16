<?php

namespace App\FeedEntities;

use App\Product;
use stdClass;

class EbayFeed implements FeedInterface
{
    public const PROVIDER = 'ebay';

    private $products = [];

    public function add(stdClass $ProductItem)
    {
        $product = new Product();
        $product->setProvider(self::PROVIDER);
        $product->setItemId($ProductItem->itemId[0]);
        $product->setPrice($ProductItem->sellingStatus[0]->currentPrice[0]->{'__value__'});
        $product->setPriceCurrency($ProductItem->sellingStatus[0]->currentPrice[0]->{'@currencyId'});
        $product->setTitle($ProductItem->title[0]);
        $this->products[] = $product;
    }

    public function getResults()
    {
        return json_encode($this->products);
    }
}
